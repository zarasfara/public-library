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
        @foreach($books as $book)
            <div class="col">
                @include('components.card-book', ['book' => $book])
            </div>
        @endforeach
    </div>

    {{ $books->appends(request()->except('page'))->links() }}

    @if(session('success'))
        <div class="position-fixed bottom-0 end-0 p-3" style="z-index: 11">
            <div id="liveToast" class="toast showing" role="alert" aria-live="assertive" aria-atomic="true">
                <div class="toast-header">
                    <svg class="bd-placeholder-img rounded me-2" width="20" height="20" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" preserveAspectRatio="xMidYMid slice" focusable="false"><rect width="100%" height="100%" fill="#008000"></rect></svg>
                    <strong class="me-auto">Успех!</strong>
                    <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                </div>
                <div class="toast-body">
                    {{session('success')}}
                </div>
            </div>
        </div>
    @endif
@endsection

@push('scripts')
    <script src="{{asset('assets/client/js/index.js')}}"></script>
@endpush
