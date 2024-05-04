@extends('admin.layouts.base')

@php
    /* @var \App\Models\BookCheckout[] $bookCheckouts */
@endphp

@section('title', 'Оформления')
@section('heading', 'Все оформления')

@section('content')
    <div class="col-12">
        <div class="card">
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
                                        ID пользователя
                                    </th>
                                    <th class="sorting sorting_asc" tabindex="0" aria-controls="example2" rowspan="1"
                                        colspan="1" aria-sort="ascending"
                                        aria-label="Rendering engine: activate to sort column descending">
                                        Кто взял
                                    </th>
                                    <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1"
                                        aria-label="Browser: activate to sort column ascending">
                                        Название книги
                                    </th>
                                    <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1"
                                        aria-label="Platform(s): activate to sort column ascending">Дата возврата
                                    </th>
                                    <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1"
                                        aria-label="Engine version: activate to sort column ascending">Вернута?
                                    </th>
                                    <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1"
                                        aria-label="Engine version: activate to sort column ascending">Действия
                                    </th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($bookCheckouts as $bookCheckout)
                                    <tr class=" odd even">
                                        <td class="dtr-control sorting_1" tabindex="0"><a href="#">{{$bookCheckout->user->id}}</a></td>
                                        <td class="dtr-control sorting_1" tabindex="0"><a href="#">{{$bookCheckout->user->name}}</a></td>
                                        <td>
                                            <a href="{{route('books.edit', $bookCheckout->book)}}">{{$bookCheckout->book->title}}</a>
                                        </td>
                                        <td>
                                            <span class="@if($bookCheckout->isOverdue()) bg-danger @endif">
                                                {{$bookCheckout->return_date->format('d.m.Y')}}
                                            </span>
                                        </td>
                                        <td>
                                            @if($bookCheckout->is_returned)
                                                Да
                                            @else
                                                Нет
                                            @endif
                                        </td>
                                        <td>
                                            @if(!$bookCheckout->is_returned)
                                            <form class="mb-2" action="{{route('checkouts.extend', $bookCheckout)}}" method="post">
                                                @method('PUT')
                                                @csrf
                                                <button class="btn btn-primary" type="submit">Продлить</button>
                                            </form>

                                                <form action="{{route('checkouts.return', $bookCheckout)}}" method="post">
                                                    @method('PUT')
                                                    @csrf
                                                    <button class="btn btn-success" type="submit">Вернуть</button>
                                                </form>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                                <tfoot>
                                <tr>
                                    <th rowspan="1" colspan="1">ID пользователя</th>
                                    <th rowspan="1" colspan="1">Кто взял</th>
                                    <th rowspan="1" colspan="1">Название книги</th>
                                    <th rowspan="1" colspan="1">Дата возврата</th>
                                    <th rowspan="1" colspan="1">Вернута?</th>
                                </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12 col-md-7">
                            {{ $bookCheckouts->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
