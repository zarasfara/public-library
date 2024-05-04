<?php

declare(strict_types=1);

namespace App\Services\Interfaces;

use App\Models\Book;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Http\UploadedFile;

interface BookServiceInterface
{
    public function searchWithPagination(array $filters, int $perPage, int $page): LengthAwarePaginator;

    public function store(array $data, UploadedFile $image): void;

    public function destroy(Book $book): void;

    public function checkOutBook(int $userId, Book $book): bool;
}
