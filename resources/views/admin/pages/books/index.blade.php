@extends('admin.layouts.base')

@php
    /* @var \App\Models\Book[] $books */
@endphp

@section('title', 'Главная')
@section('heading', 'Книжный фонд')

@section('content')
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <a href="{{route('books.create')}}" class="btn btn-primary">Создать</a>
            </div>
            <div class="card-body">
                <div id="example2_wrapper" class="dataTables_wrapper dt-bootstrap4">
                    <div class="row">
                        <div class="col-sm-12 col-md-6"></div>
                        <div class="col-sm-12 col-md-6"></div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <table id="example2" class="table table-bordered table-hover dataTable dtr-inline"
                                   aria-describedby="example2_info">
                                <thead>
                                <tr>
                                    <th class="sorting sorting_asc" tabindex="0" aria-controls="example2" rowspan="1"
                                        colspan="1" aria-sort="ascending"
                                        aria-label="Rendering engine: activate to sort column descending">
                                        Название
                                    </th>
                                    <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1"
                                        aria-label="Browser: activate to sort column ascending">
                                        Описание книги
                                    </th>
                                    <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1"
                                        aria-label="Platform(s): activate to sort column ascending">Автор
                                    </th>
                                    <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1"
                                        aria-label="Engine version: activate to sort column ascending">Наличие книги
                                    </th>
                                </tr>
                                </thead>
                                <tbody>

                                @foreach($books as $book)
                                    <tr class="@if($loop->odd) odd @else even @endif">
                                        <td class="dtr-control sorting_1" tabindex="0"><a href="#">{{$book->title}}</a></td>
                                        <td>{{$book->description}}</td>
                                        <td>{{$book->author->getFullName()}}</td>
                                        <td>{{$book->available}}</td>
                                    </tr>
                                @endforeach

                                </tbody>
                                <tfoot>
                                <tr>
                                    <th rowspan="1" colspan="1">Название</th>
                                    <th rowspan="1" colspan="1">Описание</th>
                                    <th rowspan="1" colspan="1">Автор</th>
                                    <th rowspan="1" colspan="1">Наличие книги</th>
                                </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12 col-md-7">
                            {{ $books->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
