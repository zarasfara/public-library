@extends('layouts.base')

@php
    use App\Models\Book;

    /* @var Book $book */
@endphp

@section('title', $book->title)

@section('content')
    <div class="container py-4">
        <div class="product-content product-wrap clearfix product-detail shadow-sm p-3 mb-5 bg-white rounded">
            <div class="row">
                <div class="col-md-5 col-sm-12">
                    <div class="product-image text-center">
                        <img
                            src="{{ filter_var($book->image, FILTER_VALIDATE_URL) ? $book->image : $book->getImageUrl() }}"
                            class="img-fluid rounded" alt="{{ $book->title }}">
                    </div>
                </div>
                <div class="col-md-6 offset-md-1 col-sm-12">
                    <h2 class="name text-primary mb-3">Название: {{ $book->title }}</h2>
                    <h4 class="price-container text-secondary">Автор: {{ $book->author->getFullName() }}</h4>
                    <hr class="my-4">
                    <div class="description">
                        <h5 class="font-weight-bold">Описание:</h5>
                        <p class="text-muted">{{ $book->description }}</p>
                    </div>
                    <h5 class="font-weight-bold mt-4">Жанры книги:</h5>
                    <ul class="list-unstyled">
                        @forelse($book->genres as $genre)
                            <li class="text-muted">- {{ $genre->name }}</li>
                        @empty
                            <li class="text-muted">У книги нет жанров</li>
                        @endforelse
                    </ul>
                    <hr class="my-4">
                    <div class="row">
                        <div class="col">
                            @if($book->isAvailable() && (!Auth::check() || !Auth::user()->hasCheckedOutBook($book)))
                                <form action="{{ route('checkout.book', $book) }}" method="post">
                                    @csrf
                                    <button class="btn btn-success btn-lg w-100" type="submit">
                                        Оформить
                                    </button>
                                </form>
                            @else
                                <button disabled class="btn btn-secondary btn-lg w-100">Недоступно</button>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
