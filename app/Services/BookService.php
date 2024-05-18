<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\Book;
use App\Repositories\Interfaces\BookRepositoryInterface;
use App\Services\Interfaces\BookServiceInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

final readonly class BookService implements BookServiceInterface
{
    public function __construct(
        private BookRepositoryInterface $bookRepository
    ) {
    }

    /**
     * Выполняет поиск книг с пагинацией и фильтрацией.
     *
     * @param  array  $filters  Фильтры для поиска.
     * @param  int  $perPage  Количество результатов на страницу.
     * @param  int  $page  Номер страницы.
     */
    public function searchWithPagination(array $filters, int $perPage, int $page): LengthAwarePaginator
    {
        $filteredParams = array_filter($filters, fn ($value) => ! is_null($value));

        return $this->bookRepository->searchWithPagination($filteredParams, $perPage, $page);
    }

    /**
     * Сохраняет данные новой книги.
     *
     * @param  array  $data  Данные новой книги.
     * @param  UploadedFile  $image  Загруженное изображение книги.
     */
    public function store(array $data, UploadedFile $image): void
    {
        $imagePath = $this->handleUploadedImage($image);
        $data['image'] = $imagePath;

        $book = $this->bookRepository->create($data);

        $book->genres()->attach($data['genres']);
    }

    /**
     * Обновляет данные указанной книги.
     *
     * @param  Book  $book  Экземпляр книги для обновления.
     * @param  array  $data  Данные для обновления книги.
     */
    public function update(Book $book, array $data): bool
    {
        if (array_key_exists('image', $data)) {
            if ($book->image) {
                Storage::disk('public')->delete($book->image);
            }
            $data['image'] = $this->handleUploadedImage($data['image']);
        }

        return $this->bookRepository->update($book, $data);
    }

    /**
     * Удаляет указанную книгу.
     *
     * @param  Book  $book  Экземпляр книги для удаления.
     */
    public function destroy(Book $book): void
    {
        Storage::disk('public')->delete($book->image);
        $this->bookRepository->destroy($book);
    }

    /**
     * Выполняет аренду книги пользователем.
     *
     * @param  int  $userId  Идентификатор пользователя.
     * @param  Book  $book  Книга для аренды.
     */
    public function checkOutBook(int $userId, Book $book): bool
    {
        return $this->bookRepository->checkoutBook($userId, $book);
    }

    private function handleUploadedImage(UploadedFile $image): string
    {
        return $image->store('books', 'public');
    }
}
