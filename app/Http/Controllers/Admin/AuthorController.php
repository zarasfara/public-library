<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\DeleteAuthorRequest;
use App\Http\Requests\Admin\StoreAuthorRequest;
use App\Http\Requests\Admin\UpdateAuthorRequest;
use App\Models\Author;
use App\Services\AuthorService;
use Illuminate\Support\Facades\Log;

final class AuthorController extends Controller
{
    public function __construct(
        private readonly AuthorService $authorService
    )
    {
    }

    public function index(): \Illuminate\Contracts\View\Factory|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {
        return view('admin.pages.authors.index', [
            'authors' => Author::paginate(9),
        ]);
    }

    public function create(): \Illuminate\Contracts\View\Factory|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {
        return view('admin.pages.authors.create');
    }

    public function store(StoreAuthorRequest $request): \Illuminate\Http\RedirectResponse
    {
        try {
            $data = $request->validated();
            $this->authorService->store($data);
            return redirect()->route('authors.index')->with('status', 'Author created successfully.');
        } catch (\Exception $e) {
            Log::error($e->getMessage());

            return to_route('authors.create')->withErrors(['error' => 'Failed to create author. Please try again.']);
        }
    }

    public function edit(Author $author): \Illuminate\Contracts\View\Factory|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {
        return view('admin.pages.authors.edit', compact('author'));
    }

    public function update(Author $author, UpdateAuthorRequest $request)
    {
        $data = $request->validated();

        if ($this->authorService->update($author, $data)) {
            return to_route('authors.index')->with('status', 'Author updated successfully.');
        }

        return to_route('authors.edit', $author)->withErrors(['error' => 'Failed to update author. Please try again.']);
    }

    public function destroy(DeleteAuthorRequest $request): \Illuminate\Http\RedirectResponse
    {
        try {
            $authorId = intval($request->get('author_id'));
            $this->authorService->delete($authorId);

            return redirect()->route('authors.index')->with('status', 'Author deleted successfully.');
        } catch (\Exception $e) {
            Log::error($e->getMessage());

            return redirect()->route('authors.index')->withErrors(['error' => 'Failed to delete author. Please try again.']);
        }
    }

}
