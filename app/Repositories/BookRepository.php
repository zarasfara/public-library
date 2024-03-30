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

        foreach ($filterParams as $key => $value) {
            if ($key === 'title' || $key === 'author') {
                $booksQuery->where($key, 'like', '%'.$value.'%');
            } elseif ($key === 'genres') {
                if (! empty($value)) {
                    $booksQuery->whereHas('genres', static function ($query) use ($value) {
                        $query->whereIn('id', $value);
                    });
                }
            }
        }

        return $booksQuery->get();
    }
}
