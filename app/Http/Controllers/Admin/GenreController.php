<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Genre;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

final class GenreController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.pages.genres.index')->with('genres', Genre::paginate(9));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.pages.genres.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|unique:genres',
        ]);

        Genre::create($data);

        return redirect(route('genres.index'))->with('success', 'Жанр успешно создан.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Genre $genre)
    {
        return view('admin.pages.genres.show')->with('genre', $genre);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Genre $genre)
    {
        return view('admin.pages.genres.edit')->with('genre', $genre);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Genre $genre)
    {
        $data = $request->validate([
            'name' => 'required|unique:genres,name,' . $genre->id,
        ]);

        $genre->update($data);

        return redirect(route('genres.index'))->with('success', 'Жанр успешно обновлен');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Genre $genre): RedirectResponse
    {
        if ($genre->delete()) {
            return redirect()->back()->with('success', 'Жанр успешно удален');
        }

        return redirect()->back()->with('error', 'Жанр не удален');
    }
}
