<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Models\Author;
use App\Repositories\Interfaces\AuthorRepositoryInterface;

final readonly class AuthorRepository implements AuthorRepositoryInterface
{
    public function store(array $data): void
    {
        Author::create($data);
    }

    public function delete(Author $author): void
    {
        $author->delete();
    }

    public function update(Author $author, array $data): bool
    {
        return $author->update($data);
    }
}
