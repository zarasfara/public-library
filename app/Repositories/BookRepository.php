<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Models\Book;
use App\Repositories\Interfaces\BookRepositoryInterface;
use Illuminate\Support\Facades\Schema;

final readonly class BookRepository implements BookRepositoryInterface
{
    public function getByQuery(array $filterParams): \Illuminate\Database\Eloquent\Collection
    {
        $booksQuery = Book::query();

        foreach ($filterParams as $key => $value) {
            if (($key === 'title' || $key === 'author') && Schema::hasColumn('books', $key)) {
                $booksQuery->where($key, 'like', '%'.$value.'%');
            } elseif (Schema::hasColumn('books', $key)) {
                $booksQuery->where($key, $value);
            }
        }

        return $booksQuery->get();
    }
}
