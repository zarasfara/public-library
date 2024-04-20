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

final class AuthorController extends Controller
{
    private AuthorService $authorService;

    public function __construct(AuthorService $authorService)
    {
        $this->authorService = $authorService;
    }

    public function index(): View
    {
        return view('admin.pages.authors.index', [
            'authors' => Author::paginate(9),
        ]);
    }

    public function create(): View
    {
        return view('admin.pages.authors.create');
    }

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

    public function edit(Author $author): View
    {
        return view('admin.pages.authors.edit', compact('author'));
    }

    public function update(Author $author, UpdateAuthorRequest $request): RedirectResponse
    {
        $data = $request->validated();

        if ($this->authorService->update($author, $data)) {
            return redirect()->route('authors.index')->with('status', __('messages.author_updated'));
        }

        return redirect()->route('authors.edit', $author)->withErrors(['error' => __('messages.author_update_failed')]);
    }

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
