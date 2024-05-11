<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\Book;
use App\Services\Interfaces\BookServiceInterface;
use Illuminate\Http\RedirectResponse;

final class BookController extends Controller
{
    public function __construct(
        private readonly BookServiceInterface $bookService
    ) {
    }

    /**
     * Выполняет аренду книги пользователем.
     *
     * @param Book $book Книга для аренды.
     *
     * @return RedirectResponse Редирект на предыдущую страницу.
     */
    public function checkoutBook(Book $book): RedirectResponse
    {
        $success = $this->bookService->checkoutBook(\Auth::id(), $book);

        if ($success) {
            return redirect()->back()->with('success', __('messages.book_checkout_success'));
        } else {
            return redirect()->back()->with('error', 'something went wrong');
        }
    }
}
