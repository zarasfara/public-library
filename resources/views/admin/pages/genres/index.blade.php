@extends('admin.layouts.base')
@section('title', 'Все жанры')

@php /* @var $genres \App\Models\Genre[] */ @endphp

@section('content')
    <h1>Все жанры</h1>

    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <a href="{{route('genres.create')}}" class="btn btn-primary">Создать</a>
            </div>
            <div class="card-body">
                <div id="example2_wrapper" class="dataTables_wrapper dt-bootstrap4">
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
                                    </th><th class="sorting sorting_asc" tabindex="0" aria-controls="example2" rowspan="1"
                                        colspan="1" aria-sort="ascending"
                                        aria-label="Rendering engine: activate to sort column descending">
                                        Действия
                                    </th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($genres as $genre)
                                    <tr class="odd">
                                        <td class="dtr-control sorting_1" tabindex="0"><a
                                                href="#">{{$genre->name}}</a></td>
                                        <td class="d-flex">
                                            <form class="mr-2" action="{{ route('genres.destroy', $genre) }}" method="post">
                                                @method('DELETE')
                                                @csrf
                                                <input type="hidden" name="author_id" value="{{ $genre }}">
                                                <button class="btn btn-danger" type="submit">Удалить</button>
                                            </form>
                                            <a href="{{ route('genres.edit', $genre) }}" class="btn btn-primary">Изменить</a>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                                <tfoot>
                                <tr>
                                    <th rowspan="1" colspan="1">Название</th>
                                    <th rowspan="2" colspan="2">Действия</th>
                                </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12 col-md-7">
                            {{ $genres->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
