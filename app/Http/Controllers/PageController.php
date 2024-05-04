<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\Genre;
use App\Services\Interfaces\BookServiceInterface;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

final class PageController extends Controller
{
    private const int PER_PAGE = 9;

    public function __construct(
        private readonly BookServiceInterface $bookService
    ) {
    }

    /**
     * Отображает панель управления.
     *
     * @return View Представление панели управления.
     */
    public function dashboard(): View
    {
        return view('pages.dashboard');
    }

    /**
     * Отображает страницу со списком книг.
     *
     * @param  Request  $request  Запрос на отображение страницы.
     * @return View Представление страницы со списком книг.
     */
    public function index(Request $request): View
    {
        $filterParams = $request->query();
        $currentPage = (int) $request->query('page', 1);

        $books = $this->bookService->searchWithPagination($filterParams, self::PER_PAGE, $currentPage);

        return view('pages.index', [
            'books' => $books,
            'genres' => Genre::all(),
        ]);
    }
}
