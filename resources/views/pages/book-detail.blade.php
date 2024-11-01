@extends('layouts.base')

@php
    use App\Models\Book;

    /* @var Book $book */
@endphp

@section('content')
    <div class="container">
        <div class="product-content product-wrap clearfix product-deatil">
            <div class="row">
                <div class="col-md-5 col-sm-12 col-xs-12">
                    <div class="product-image">
                        <img style="width: 100%; object-fit: contain; height: 100%;"
                             src="{{ filter_var($book->image, FILTER_VALIDATE_URL) ? $book->image : $book->getImageUrl() }}"
                             class="img-responsive" alt="">
                    </div>
                </div>
                <div class="col-md-6 col-md-offset-1 col-sm-12 col-xs-12">
                    <h2 class="name">{{$book->title}}</h2>
                    <hr>
                    <h3 class="price-container"> Автор: {{$book->author->getFullName()}}</h3>
                    <hr>
                    <div class="description description-tabs">
                        <ul id="myTab" class="nav nav-pills">
                            <p>{{$book->description}}</p>
                        </ul>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-sm-12 col-md-6 col-lg-6"><a href="javascript:void(0);"
                                                                    class="btn btn-success btn-lg">Оформить</a></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
