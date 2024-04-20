<?php

declare(strict_types=1);

namespace App\Services;

use App\Http\Requests\Admin\UpdateBookRequest;
use App\Models\Book;
use App\Repositories\Interfaces\BookRepositoryInterface;
use App\Services\Interfaces\BookServiceInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

final readonly class BookService implements BookServiceInterface
{
    public function __construct(
        private BookRepositoryInterface $bookRepository
    )
    {
    }

    public function searchWithPagination(array $filters, int $perPage, int $page): LengthAwarePaginator
    {
        $filteredParams = array_filter($filters, fn($value) => !is_null($value));

        return $this->bookRepository->searchWithPagination($filteredParams, $perPage, $page);
    }

    public function store(array $data, UploadedFile $image): void
    {
        $imagePath = $this->handleUploadedImage($image);
        $data['image'] = $imagePath;

        $book = $this->bookRepository->create($data);

        $book->genres()->attach($data['genres']);
    }

    public function update(Book $book, array $data): bool
    {
        if (array_key_exists('image', $data)) {
            if ($book->image) {
                Storage::disk('public')->delete($book->image);
            }
            $data['image'] = $this->handleUploadedImage($data['image']);
        }

        return $this->bookRepository->update($book, $data);
    }

    private function handleUploadedImage(UploadedFile $image): string
    {
        return $image->store('books', 'public');
    }

    public function destroy(Book $book): void
    {
        Storage::disk('public')->delete($book->image);
        $this->bookRepository->destroy($book);
    }
}
