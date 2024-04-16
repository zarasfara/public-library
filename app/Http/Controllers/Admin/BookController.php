<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreBookRequest;
use App\Http\Requests\Admin\UpdateBookRequest;
use App\Models\Author;
use App\Models\Book;
use App\Models\Genre;
use App\Services\Interfaces\BookServiceInterface;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

final class BookController extends Controller
{
    public function __construct(
        private readonly BookServiceInterface $bookService
    ) {
    }

    public function index(): View
    {
        return view('admin.pages.books.index', [
            'books' => Book::paginate(9),
        ]);
    }

    public function create(): View
    {
        return view('admin.pages.books.create', [
            'genres' => Genre::all(),
            'authors' => Author::all(),
        ]);
    }

    public function store(StoreBookRequest $request): RedirectResponse
    {
        $data = $request->validated();
        $image = $request->file('image');

        $this->bookService->store($data, $image);

        return redirect()->back();
    }

    public function edit(Book $book): View
    {
        return view('admin.pages.books.edit', [
            'book' => $book,
            'authors' => Author::all(),
            'genres' => Genre::all(),
        ]);
    }

    public function update(Book $book, UpdateBookRequest $request): RedirectResponse
    {
        $data = $request->validated();

        $result = $this->bookService->update($book, $data);

        if ($result) {
            return redirect()->route('books.index')->with('success', __('messages.book_updated'));
        } else {
            return redirect()->back()->with('error', __('messages.book_update_failed'));
        }
    }

    public function destroy(Book $book): RedirectResponse
    {
        $this->bookService->destroy($book);

        return redirect()->back();
    }
}
