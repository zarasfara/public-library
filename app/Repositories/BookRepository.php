<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Models\Book;
use App\Models\BookCheckout;
use App\Repositories\Interfaces\BookRepositoryInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

final readonly class BookRepository implements BookRepositoryInterface
{
    /**
     * Выполняет поиск книг с пагинацией и фильтрацией.
     *
     * @param  array  $filterParams  Параметры фильтрации.
     * @param  int  $perPage  Количество результатов на страницу.
     * @param  int  $page  Номер страницы.
     */
    public function searchWithPagination(array $filterParams, int $perPage, int $page): LengthAwarePaginator
    {
        $booksQuery = Book::query();

        $conditions = [
            'title' => function ($query, $value) {
                $query->where('title', 'like', '%'.$value.'%');
            },
            'author' => function ($query, $value) {
                $query->whereHas('author', function ($query) use ($value) {
                    $query->whereRaw("CONCAT_WS(' ', first_name, last_name, patronymic) LIKE ?", ['%'.$value.'%']);
                });
            },
            'genres' => function ($query, $value) {
                $query->whereHas('genres', function ($query) use ($value) {
                    $query->whereIn('id', $value);
                });
            },
        ];

        foreach ($filterParams as $key => $value) {
            if (array_key_exists($key, $conditions)) {
                $conditions[$key]($booksQuery, $value);
            }
        }

        return $booksQuery->paginate(
            perPage: $perPage,
            columns: ['id', 'title', 'description', 'author_id', 'available', 'image'],
            page: $page
        );
    }

    /**
     * Обновляет данные указанной книги.
     *
     * @param  Book  $book  Экземпляр книги для обновления.
     * @param  array  $data  Данные для обновления книги.
     */
    public function update(Book $book, array $data): bool
    {
        $book->fill($data);

        return $book->save();
    }

    /**
     * Создает новую книгу на основе предоставленных данных.
     *
     * @param  array  $data  Данные для создания книги.
     * @return Book Созданный экземпляр книги.
     */
    public function create(array $data): Book
    {
        return Book::create($data);
    }

    /**
     * Удаляет указанную книгу.
     *
     * @param  Book  $book  Экземпляр книги для удаления.
     */
    public function destroy(Book $book): void
    {
        $book->delete();
    }

    /**
     * Арендует указанную книгу пользователем.
     *
     * @param  int  $userId  Идентификатор пользователя.
     * @param  Book  $book  Экземпляр книги для аренды.
     *
     * @throws \Throwable
     */
    public function checkOutBook(int $userId, Book $book): bool
    {
        try {
            return DB::transaction(function () use ($userId, $book) {
                $book->decrement('available');

                /**
                 * @var BookCheckout $checkout
                 */
                $checkout = $book->bookCheckouts()->create([
                    'user_id' => $userId,
                    'return_date' => now()->addMonth(),
                ]);

                return ! is_null($checkout);
            });
        } catch (\Exception $e) {
            Log::error('Error while checking out book: '.$e->getMessage());

            return false;
        }
    }
}
