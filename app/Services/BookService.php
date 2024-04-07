<?php

declare(strict_types=1);

namespace App\Services;

use App\Repositories\Interfaces\BookRepositoryInterface;
use App\Services\Interfaces\BookServiceInterface;

final readonly class BookService implements BookServiceInterface
{
    public function __construct(
        private BookRepositoryInterface $bookRepository
    ) {
    }

    public function getByQuery(array $filters): \Illuminate\Database\Eloquent\Collection
    {
        $filteredParams = array_filter($filters, fn ($value) => ! is_null($value));

        return $this->bookRepository->getByQuery($filteredParams);
    }
}
