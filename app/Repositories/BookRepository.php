<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Models\Book;
use App\Repositories\Interfaces\BookRepositoryInterface;

final readonly class BookRepository implements BookRepositoryInterface
{
    public function getByQuery(array $filterParams): \Illuminate\Database\Eloquent\Collection
    {
        $booksQuery = Book::query();

        $conditions = [
            'title' => function ($query, $value) {
                $query->where('title', 'like', '%' . $value . '%');
            },
            'author' => function ($query, $value) {
                $query->whereHas('author', function ($query) use ($value) {
                    $query->where(function ($query) use ($value) {
                        $query->where('first_name', 'like', '%' . $value . '%')
                            ->orWhere('last_name', 'like', '%' . $value . '%')
                            ->orWhere('patronymic', 'like', '%' . $value . '%');
                    });
                });
            },
            'genres' => function ($query, $value) {
                if (!empty($value)) {
                    $query->whereHas('genres', function ($query) use ($value) {
                        $query->whereIn('id', $value);
                    });
                }
            },
        ];

        foreach ($filterParams as $key => $value) {
            if (array_key_exists($key, $conditions)) {
                $conditions[$key]($booksQuery, $value);
            }
        }

        return $booksQuery->get();
    }
}
