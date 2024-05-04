<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Models\Author;
use App\Repositories\Interfaces\AuthorRepositoryInterface;

final readonly class AuthorRepository implements AuthorRepositoryInterface
{
    /**
     * Сохраняет данные нового автора.
     *
     * @param array $data Данные нового автора.
     *
     * @return void
     */
    public function store(array $data): void
    {
        Author::create($data);
    }

    /**
     * Удаляет указанного автора.
     *
     * @param Author $author Экземпляр автора.
     *
     * @return void
     */
    public function delete(Author $author): void
    {
        $author->delete();
    }

    /**
     * Обновляет данные указанного автора.
     *
     * @param Author $author Экземпляр автора.
     * @param array $data Данные для обновления автора.
     *
     * @return bool
     */
    public function update(Author $author, array $data): bool
    {
        return $author->update($data);
    }
}
