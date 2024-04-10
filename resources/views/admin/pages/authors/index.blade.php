@extends('admin.layouts.base')

@php
    /* @var \App\Models\Author[] $authors */
@endphp

@section('title', 'Главная')
@section('heading', 'Авторы')

@section('content')
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <a href="{{route('authors.create')}}" class="btn btn-primary">Создать</a>
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
                                        Имя
                                    </th>
                                    <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1"
                                        aria-label="Browser: activate to sort column ascending">
                                        Фамилия
                                    </th>
                                    <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1"
                                        aria-label="Platform(s): activate to sort column ascending">Отчество
                                    </th>
                                    <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1"
                                        aria-label="Platform(s): activate to sort column ascending">Действия
                                    </th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($authors as $author)
                                    <tr class="odd">
                                        <td class="dtr-control sorting_1" tabindex="0"><a
                                                href="#">{{$author->first_name}}</a></td>
                                        <td>{{$author->last_name}}</td>
                                        <td>{{$author->patronymic ?? '-'}}</td>
                                        <td>
                                            <form class="" action="{{route('authors.destroy', $author->id)}}" method="post">
                                                @method('DELETE')
                                                @csrf
                                                <input type="hidden" name="author_id" value="{{ $author->id }}">
                                                <button class="btn btn-danger" type="submit">Удалить</button>
                                            </form>
                                            <a href="{{route('authors.edit', $author->id)}}" class="btn btn-primary">Изменить</a>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                                <tfoot>
                                <tr>
                                    <th rowspan="1" colspan="1">Имя</th>
                                    <th rowspan="1" colspan="1">Фамилия</th>
                                    <th rowspan="1" colspan="1">Отчество</th>
                                </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12 col-md-7">
                            {{ $authors->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection

