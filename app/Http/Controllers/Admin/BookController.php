<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Book;
use Illuminate\Http\Request;

final class BookController extends Controller
{
    public function index(Request $request)
    {
        return view('admin.pages.books.index', [
            'books' => Book::paginate(9)
        ]);
    }
}
