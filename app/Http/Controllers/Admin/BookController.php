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
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

final class BookController extends Controller
{
    public function __construct(
        private readonly BookServiceInterface $bookService
    )
    {
    }

    public function index(Request $request): Factory|Application|View|\Illuminate\Contracts\Foundation\Application
    {
        return view('admin.pages.books.index', [
            'books' => Book::paginate(9),
        ]);
    }

    public function create(Request $request): Factory|Application|View|\Illuminate\Contracts\Foundation\Application
    {
        return view('admin.pages.books.create', [
            'genres' => Genre::all(),
            'authors' => Author::all(),
        ]);
    }

    public function store(StoreBookRequest $request): \Illuminate\Http\RedirectResponse
    {
        $data = $request->validated();
        $image = $request->file('image');

        $this->bookService->store($data, $image);

        return redirect()->back();
    }

    public function edit(Book $book): Factory|Application|View|\Illuminate\Contracts\Foundation\Application
    {
        return view('admin.pages.books.edit', [
            'book' => $book,
            'authors' => Author::all(),
            'genres' => Genre::all(),
        ]);
    }

    public function update(Book $book, UpdateBookRequest $request)
    {
        $data = $request->validated();

        $book->fill($data);

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('books', 'public');
            if ($book->image) {
                Storage::delete($book->image);
            }
            $book->image = $imagePath;
        }

        if ($book->save()) {
            return redirect()->route('books.index', $book->id)->with('success', 'Book updated successfully.');
        } else {
            return redirect()->back()->with('error', 'Failed to update book.');
        }
    }


    public function destroy(Book $book): \Illuminate\Http\RedirectResponse
    {
        \Storage::delete($book->image);
        $book->delete();

        return redirect()->back();
    }
}
