@extends('layouts.base')
@php
    /* @var \App\Models\Genre[] $genres  */
    /* @var \App\Models\Book[] $books  */
@endphp

@section('title', 'Главная страница')

@section('content')
    <div class="mb-3">
        <form action="" method="GET">
            <div class="row">
                <div class="col">
                    <label for="title" class="form-label">Название книги</label>
                    <input type="text" class="form-control" id="title" name="title">
                </div>
                <div class="col">
                    <label for="author" class="form-label">Автор</label>
                    <input type="text" class="form-control" id="author" name="author">
                </div>
            </div>
            <div class="mb-3">
                <label for="genre" class="form-label">Жанры</label>
                <select class="form-select" id="genre" name="genres[]" multiple>
                    @foreach($genres as $genre)
                        <option value="{{$genre->id}}">{{$genre->name}}</option>
                    @endforeach
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Применить фильтр</button>
        </form>
    </div>
    <div class="row row-cols-1 row-cols-md-3 g-4 mb-4">
        @forelse($books as $book)
            <div class="col">
                @include('components.card-book', $book)
            </div>
        @empty
            <div class="alert alert-danger" role="alert">
                Ничего не найдено!
            </div>
        @endforelse
    </div>

    {{ $books->appends(request()->except('page'))->links() }}

@endsection
