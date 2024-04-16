<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Models\Book;
use App\Repositories\Interfaces\BookRepositoryInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

final readonly class BookRepository implements BookRepositoryInterface
{
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
            columns: ['title', 'description', 'author_id', 'available', 'image'],
            page: $page
        );
    }

    public function update(Book $book, array $data): bool
    {
        $book->fill($data);

        return $book->save();
    }

    public function create(array $data): Book
    {
        return Book::create($data);
    }

    public function destroy(Book $book): void
    {
        $book->delete();
    }
}
