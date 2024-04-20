<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\Author;
use App\Repositories\Interfaces\AuthorRepositoryInterface;

final readonly class AuthorService implements Interfaces\AuthorServiceInterface
{
    public function __construct(
        private AuthorRepositoryInterface $authorRepository
    ) {
    }

    public function store(array $data): void
    {
        $this->authorRepository->store($data);
    }

    public function delete(Author $author): void
    {
        // read the warning below https://laravel.com/docs/11.x/eloquent#events
        // it's not my mistake...
        $author->books()->delete();

        $this->authorRepository->delete($author);
    }

    public function update(Author $author, array $data): bool
    {
        return $this->authorRepository->update($author, $data);
    }
}
