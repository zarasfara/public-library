@extends('admin.layouts.base')
@section('title', 'Изменить жанр')

@php /* @var $genre \App\Models\Genre */ @endphp

@section('content')
    <h1>Изменить название жанра - {{$genre->name}}</h1>
    <form action="{{route('genres.update', $genre)}}" method="post">
        @csrf
        @method('PATCH')
        <div class="form-group">
            <label for="genreName">Новое название жанра</label>
            <input name="name" type="text" class="form-control" id="genreName" placeholder="Введите новое название">
        </div>

        <button class="btn btn-primary" type="submit">Обновить</button>
    </form>
@endsection
