<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreAuthorRequest;
use App\Http\Requests\Admin\UpdateAuthorRequest;
use App\Models\Author;
use App\Services\AuthorService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Log;

/**
 * Класс AuthorController
 *
 * @package App\Http\Controllers\Admin
 */
final class AuthorController extends Controller
{
    private AuthorService $authorService;

    public function __construct(AuthorService $authorService)
    {
        $this->authorService = $authorService;
    }

    /**
     * Отображает список авторов.
     *
     * @return View Вид для списка авторов.
     */
    public function index(): View
    {
        return view('admin.pages.authors.index', [
            'authors' => Author::paginate(9),
        ]);
    }

    /**
     * Отображает форму создания нового автора.
     *
     * @return View Вид для создания нового автора.
     */
    public function create(): View
    {
        return view('admin.pages.authors.create');
    }

    /**
     * Сохраняет вновь созданный ресурс в хранилище.
     *
     * @param StoreAuthorRequest $request Объект запроса.
     *
     * @return RedirectResponse Редирект на страницу.
     */
    public function store(StoreAuthorRequest $request): RedirectResponse
    {
        try {
            $data = $request->validated();
            $this->authorService->store($data);

            return redirect()->route('authors.index')->with('status', __('messages.author_created'));
        } catch (\Exception $e) {
            Log::error($e->getMessage());

            return redirect()->route('authors.create')->withErrors(['error' => __('messages.author_create_failed')]);
        }
    }

    /**
     * Отображает форму редактирования указанного автора.
     *
     * @param \App\Models\Author $author Экземпляр автора для редактирования.
     *
     * @return View Вид для редактирования автора.
     */
    public function edit(Author $author): View
    {
        return view('admin.pages.authors.edit', compact('author'));
    }

    /**
     * Обновляет указанный ресурс в хранилище.
     *
     * @param \App\Models\Author $author Экземпляр автора для обновления.
     * @param UpdateAuthorRequest $request Объект запроса.
     *
     * @return RedirectResponse Редирект на страницу.
     */
    public function update(Author $author, UpdateAuthorRequest $request): RedirectResponse
    {
        $data = $request->validated();

        if ($this->authorService->update($author, $data)) {
            return redirect()->route('authors.index')->with('status', __('messages.author_updated'));
        }

        return redirect()->route('authors.edit', $author)->withErrors(['error' => __('messages.author_update_failed')]);
    }

    /**
     * Удаляет указанный ресурс из хранилища.
     *
     * @param \App\Models\Author $author Экземпляр автора для удаления.
     *
     * @return RedirectResponse Редирект на страницу.
     */
    public function destroy(Author $author): RedirectResponse
    {
        try {
            $this->authorService->delete($author);

            return redirect()->route('authors.index')->with('status', __('messages.author_deleted'));
        } catch (\Exception $e) {
            Log::error($e->getMessage());

            return redirect()->route('authors.index')->withErrors(['error' => __('messages.author_delete_failed')]);
        }
    }
}
