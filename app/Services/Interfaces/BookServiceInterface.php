<?php

declare(strict_types=1);

namespace App\Services\Interfaces;

interface BookServiceInterface
{
    public function getByQuery(array $filters): \Illuminate\Database\Eloquent\Collection;
}
