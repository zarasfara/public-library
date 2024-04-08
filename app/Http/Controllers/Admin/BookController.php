<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreBookRequest;
use App\Models\Author;
use App\Models\Book;
use App\Models\Genre;
use App\Services\Interfaces\BookServiceInterface;
use Illuminate\Http\Request;

final class BookController extends Controller
{
    public function __construct(
        private readonly BookServiceInterface $bookService
    ) {
    }

    public function index(Request $request)
    {
        return view('admin.pages.books.index', [
            'books' => Book::paginate(9),
        ]);
    }

    public function create(Request $request)
    {
        return view('admin.pages.books.create', [
            'genres' => Genre::all(),
            'authors' => Author::all(),
        ]);
    }

    public function store(StoreBookRequest $request)
    {
        $data = $request->validated();
        $image = $request->file('image');

        $this->bookService->store($data, $image);

        return redirect()->back();
    }
}
