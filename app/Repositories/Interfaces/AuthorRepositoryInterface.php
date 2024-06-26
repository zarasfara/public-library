<?php

declare(strict_types=1);

namespace App\Repositories\Interfaces;

use App\Models\Author;

interface AuthorRepositoryInterface
{
    public function store(array $data): void;

    public function delete(Author $author): void;

    public function update(Author $author, array $data): bool;
}
