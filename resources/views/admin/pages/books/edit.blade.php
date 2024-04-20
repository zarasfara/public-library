@extends('admin.layouts.base')

@php
    /* @var \App\Models\Genre[] $genres */
    /* @var \App\Models\Author[] $authors */
    /* @var \App\Models\Book $book*/
@endphp

@section('title', 'Изменение книги')
@section('heading', 'Изменение книги в библиотечный фонд')

@push('admin.styles')
    <link href="{{asset('assets/admin/select2/css/select2.min.css')}}" rel="stylesheet"/>
    <link href="{{asset('assets/admin/select2/css/select2-bootstrap4.min.css')}}" rel="stylesheet"/>
@endpush

@section('content')
    <div class="card card-primary">
        <form action="{{route('books.update', $book->id)}}" method="post" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="card-body">
                <div class="row">
                    <div class="form-group col">
                        <label for="name-input">Название</label>
                        <input name="title" type="text" class="form-control @error('title') is-invalid @enderror"
                               id="name-input" placeholder="Введите название" value="{{$book->title}}">
                        @error('title')
                        <span id="name-input-error" class="error invalid-feedback">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="form-group col">
                        <label for="description-input">Описание</label>
                        <textarea name="description" type="text"
                                  class="form-control @error('description') is-invalid @enderror" id="description-input"
                                  placeholder="Описание">{{$book->description}}</textarea>
                        @error('description')
                        <span id="name-input-error" class="error invalid-feedback">{{$message}}</span>
                        @enderror
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col">
                        <label for="available-input">Доступно</label>
                        <input name="available" type="number"
                               class="form-control @error('available') is-invalid @enderror" id="available-input"
                               placeholder="Введите сколько доступно экземпляров" value="{{$book->available}}">
                        @error('available')
                        <span id="name-input-error" class="error invalid-feedback">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="form-group col">
                        <label for="exampleInputFile">Изображение</label>
                        <div class="input-group">
                            <div class="custom-file">
                                <div class="custom-file">
                                    <input name="image" type="file"
                                           class="custom-file-input @error('image') is-invalid @enderror"
                                           id="validatedCustomFile">
                                    <label class="custom-file-label" for="validatedCustomFile">Выберите файл...</label>
                                    @error('image')
                                    <div class="invalid-feedback">{{$message}}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="input-group-append">
                                <span class="input-group-text">Загрузить</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>Жанры</label>
                            <select name="genres[]" multiple="multiple"
                                    class="form-control genres-select @error('genres') is-invalid @enderror">
                                @foreach($genres as $genre)
                                    <option
                                        @if(in_array($genre->id, $book->genres->pluck('id')->toArray()))
                                            selected
                                        @endif value="{{$genre->id}}">{{$genre->name}}</option>
                                @endforeach
                            </select>
                            @error('genres')
                            <span id="name-input-error" class="error invalid-feedback ">{{$message}}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>Автор</label>
                            <select name="author_id"
                                    class="form-control author-select @error('author_id') is-invalid @enderror">
                                @foreach($authors as $author)
                                    <option
                                        {{ $book->author->getFullName() === $author->getFullName() ? 'selected' : ''}}
                                        value="{{$author->id}}">{{$author->getFullName()}}</option>
                                @endforeach
                            </select>
                            @error('author_id')
                            <span id="name-input-error" class="error invalid-feedback">{{$message}}</span>
                            @enderror
                        </div>
                    </div>
                    <img src="{{ filter_var($book->image, FILTER_VALIDATE_URL) ? $book->image : $book->getImageUrl() }}" alt="aboba" class="img-thumbnail">
                </div>

            </div>
            <div class="card-footer">
                <button type="submit" class="btn btn-primary">Изменить</button>
            </div>
        </form>
    </div>

    @push('admin.scripts')
        <script src="{{asset('assets/admin/js/pages/books/create.js')}}"></script>
    @endpush
@endsection
