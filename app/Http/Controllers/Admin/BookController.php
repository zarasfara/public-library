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

    /**
     * Отображает список ресурсов.
     *
     * @return View Вид для списка книг.
     */
    public function index(): View
    {
        return view('admin.pages.books.index', [
            'books' => Book::with('author')->paginate(9),
        ]);
    }

    /**
     * Отображает форму создания нового ресурса.
     *
     * @return View Вид для создания новой книги.
     */
    public function create(): View
    {
        return view('admin.pages.books.create', [
            'genres' => Genre::all(),
            'authors' => Author::all(),
        ]);
    }

    /**
     * Сохраняет вновь созданный ресурс в хранилище.
     *
     * @param  StoreBookRequest  $request  Объект запроса.
     * @return RedirectResponse Редирект на предыдущую страницу.
     */
    public function store(StoreBookRequest $request): RedirectResponse
    {
        $data = $request->validated();
        $image = $request->file('image');

        $this->bookService->store($data, $image);

        return redirect()->back()->with('success', 'Книга успешно добавлена');
    }

    /**
     * Отображает форму редактирования указанного ресурса.
     *
     * @param  \App\Models\Book  $book  Экземпляр книги для редактирования.
     * @return View Вид для редактирования книги.
     */
    public function edit(Book $book): View
    {
        return view('admin.pages.books.edit', [
            'book' => $book,
            'authors' => Author::all(),
            'genres' => Genre::all(),
        ]);
    }

    /**
     * Обновляет указанный ресурс в хранилище.
     *
     * @param  \App\Models\Book  $book  Экземпляр книги для обновления.
     * @param  UpdateBookRequest  $request  Объект запроса.
     * @return RedirectResponse Редирект на предыдущую страницу.
     */
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

    /**
     * Удаляет указанный ресурс из хранилища.
     *
     * @param  \App\Models\Book  $book  Экземпляр книги для удаления.
     * @return RedirectResponse Редирект на предыдущую страницу.
     */
    public function destroy(Book $book): RedirectResponse
    {
        $this->bookService->destroy($book);

        return redirect()->back();
    }
}
