@extends('admin.layouts.base')

@php
    /* @var \App\Models\Author[] $authors */
    /* @var \App\Models\Author $author */
@endphp

@section('title', 'Изменение автора')
@section('heading', 'Изменение автора')

@section('content')
    <div class="card card-primary">
        <form action="{{route('authors.update', $author->id)}}" method="post">
            @csrf
            @method('PATCH')
            <div class="card-body">
                <div class="row">
                    <div class="form-group col">
                        <label for="name-input">Имя</label>
                        <input name="first_name" type="text" class="form-control @error('first_name') is-invalid @enderror"
                               id="name-input" placeholder="Введите название" value="{{$author->first_name}}">
                        @error('first_name')
                        <span id="name-input-error" class="error invalid-feedback">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="form-group col">
                        <label for="description-input">Фамилия</label>
                        <input name="last_name" type="text" class="form-control @error('last_name') is-invalid @enderror" id="description-input"
                               placeholder="Фамилия" value="{{$author->last_name}}">
                        @error('last_name')
                        <span id="name-input-error" class="error invalid-feedback">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="form-group col">
                        <label for="available-input">Отчество</label>
                        <input name="patronymic" type="text" class="form-control @error('patronymic') is-invalid @enderror" id="available-input"
                               placeholder="Отчество" value="{{$author->patronymic}}">
                        @error('patronymic')
                        <span id="name-input-error" class="error invalid-feedback">{{$message}}</span>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <button type="submit" class="btn btn-primary">Сохранить</button>
            </div>
        </form>
    </div>

    @push('admin.scripts')
        <script src="{{asset('assets/admin/js/pages/books/create.js')}}"></script>
    @endpush
@endsection
