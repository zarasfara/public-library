<?php

declare(strict_types=1);

namespace App\Services\Interfaces;

use Illuminate\Http\UploadedFile;

interface BookServiceInterface
{
    public function getByQuery(array $filters): \Illuminate\Database\Eloquent\Collection;

    public function store(array $data, UploadedFile $image): void;
}
