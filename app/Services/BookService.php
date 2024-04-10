<?php

declare(strict_types=1);

namespace App\Services;

use App\Repositories\Interfaces\BookRepositoryInterface;
use App\Services\Interfaces\BookServiceInterface;
use Illuminate\Http\UploadedFile;

final readonly class BookService implements BookServiceInterface
{
    public function __construct(
        private BookRepositoryInterface $bookRepository
    ) {
    }

    public function getByQuery(array $filters): \Illuminate\Database\Eloquent\Collection
    {
        $filteredParams = array_filter($filters, fn ($value) => ! is_null($value));

        return $this->bookRepository->getByQuery($filteredParams);
    }

    public function store(array $data, UploadedFile $image): void
    {
        $imagePath = $this->handleUploadedImage($image);
        $data['image'] = $imagePath;

        $book = $this->bookRepository->create($data);

        $book->genres()->attach($data['genres']);
    }

    private function handleUploadedImage(UploadedFile $image): string
    {
        return $image->store('images/books', 'public');
    }
}
