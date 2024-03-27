<?php

declare(strict_types=1);

namespace App\Repositories\Interfaces;

interface BookRepositoryInterface
{
    /**
     * @param  array  $filterParams  Параметры для поиска.
     */
    public function getByQuery(array $filterParams): \Illuminate\Database\Eloquent\Collection;
}
