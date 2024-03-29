<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Services\Interfaces\BookServiceInterface;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;

final class PageController extends Controller
{
    public function __construct(
        private readonly BookServiceInterface $bookService
    ) {
    }

    public function index(Request $request): View
    {
        $filterParams = $request->query();

        $books = $this->bookService->getByQuery($filterParams);

        $page = Paginator::resolveCurrentPage();

        $perPage = 9;

        $paginatedItems = $books->forPage($page, $perPage);

        $paginatedBooks = new LengthAwarePaginator(
            items: $paginatedItems,
            total: $books->count(),
            perPage: $perPage,
            currentPage: $page
        );

        return view('pages.index', [
            'books' => $paginatedBooks,
        ]);
    }
}
