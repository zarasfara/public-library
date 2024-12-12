@extends('admin.layouts.base')
@section('title', 'Создать жанр')

@php /* @var $genre \App\Models\Genre */ @endphp

@section('content')
    <h1>Создать жанр</h1>
    <form action="{{route('genres.store')}}" method="post">
        @csrf
        <div class="form-group">
            <label for="genreName">Название жанра</label>
            <input name="name" type="text" class="form-control" id="genreName" placeholder="Введите название жанра">
        </div>

        <button class="btn btn-primary" type="submit">Создать</button>
    </form>
@endsection
