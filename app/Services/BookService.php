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

    public function getByQuery(array $filterParams): \Illuminate\Database\Eloquent\Collection
    {
        return $this->bookRepository->getByQuery($filterParams);
    }
}
