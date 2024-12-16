<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BookCheckout;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

final class BookCheckoutController extends Controller
{
    public function index(): View
    {
        return view('admin.pages.book_checkouts.index', [
            'bookCheckouts' => BookCheckout::with(['user', 'book'])
                ->orderBy('is_returned') // Сортировка по полю is_returned
                ->paginate(8),
        ]);
    }

    public function extendCheckout(BookCheckout $bookCheckout): RedirectResponse
    {
        $newReturnDate = $bookCheckout->return_date->addMonth();

        $bookCheckout->update(['return_date' => $newReturnDate]);

        return redirect()->back();
    }

    public function returnBook(BookCheckout $bookCheckout): RedirectResponse
    {
        $bookCheckout->book->increment('available');

        $bookCheckout->update([
            'is_returned' => true,
        ]);

        return redirect()->back()->with('success', __('messages.book_returned'));
    }
}
