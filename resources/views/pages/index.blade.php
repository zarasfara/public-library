@extends('layouts.base')
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
                <label for="genre" class="form-label">Жанр</label>
                <select class="form-select" id="genre" name="genre">
                    <option value="">Выберите жанр</option>
                    <option value="Фантастика">Фантастика</option>
                    <option value="Роман">Роман</option>
                    <option value="Детектив">Детектив</option>
                    <option value="Приключения">Приключения</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Применить фильтр</button>
        </form>
    </div>
    <div class="row row-cols-1 row-cols-md-3 g-4">
        @foreach($books as $book)
            <div class="col">
                @include('components.card-book', $book)
            </div>
        @endforeach
    </div>
@endsection


