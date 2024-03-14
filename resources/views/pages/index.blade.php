@extends('layouts.base')
@section('content')
    <div class="row row-cols-1 row-cols-md-3 g-4">
        @for ($i = 0; $i < 9; $i++)
            <div class="col">
                @include('components.card-book')
            </div>
        @endfor
    </div>
@endsection


