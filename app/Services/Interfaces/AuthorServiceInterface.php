<?php

declare(strict_types=1);

namespace App\Services\Interfaces;

use App\Models\Author;

interface AuthorServiceInterface
{
    public function store(array $data): void;

    public function delete(Author $author): void;

    public function update(Author $author, array $data): bool;
}
