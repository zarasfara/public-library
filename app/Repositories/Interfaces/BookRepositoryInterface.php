<?php

declare(strict_types=1);

namespace App\Repositories\Interfaces;

use App\Models\Book;
use Illuminate\Database\Eloquent\Collection;

interface BookRepositoryInterface
{
    /**
     * @param  array  $filterParams  Параметры для поиска.
     * @return Collection<Book>
     */
    public function getByQuery(array $filterParams): \Illuminate\Database\Eloquent\Collection;
}
