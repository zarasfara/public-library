<?php

declare(strict_types=1);

namespace App\Repositories\Interfaces;

use App\Models\Book;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

interface BookRepositoryInterface
{
    /**
     * @param  array  $filterParams  Параметры для поиска.
     */
    public function searchWithPagination(array $filterParams, int $perPage, int $page): LengthAwarePaginator;

    public function create(array $data): Book;

    public function update(Book $book, array $data): bool;

    public function destroy(Book $book): void;

    public function checkOutBook(int $userId, Book $book): bool;
}
