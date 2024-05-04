<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BookCheckout;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

final class BookCheckoutController extends Controller
{
    /**
     * @return View
     */
    public function index(): View
    {
        return view('admin.pages.book_checkouts.index', [
            'bookCheckouts' => BookCheckout::with(['user', 'book'])->paginate(8)
        ]);
    }

    /**
     * @param BookCheckout $bookCheckout
     * @return RedirectResponse
     */
    public function extendCheckout(BookCheckout $bookCheckout): RedirectResponse
    {
        $newReturnDate = $bookCheckout->return_date->addMonth();

        $bookCheckout->update(['return_date' => $newReturnDate]);

        return redirect()->back();
    }

    /**
     * @param BookCheckout $bookCheckout
     * @return RedirectResponse
     */
    public function returnBook(BookCheckout $bookCheckout): RedirectResponse
    {
        $bookCheckout->book->increment('available');

        $bookCheckout->update([
            'is_returned' => true
        ]);

        return redirect()->back()->with('success', __('book_returned'));
    }
}
