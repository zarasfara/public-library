<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="{{ $meta->description }}">
    <meta name="keywords" content="{{ $meta->keywords }}">
    <meta name="robots" content="{{ $meta->robots }}">

    <title>{{$meta->title}} - @yield('title')</title>

    <link rel="stylesheet" href="{{asset('assets/client/css/bootstrap-5.css')}}">
    @stack('style sheets')
</head>

<body>
<div class="container">
    @include('components.header')
    @yield('content')
</div>

<script src="{{asset('assets/client/js/bootstrap-5.js')}}"></script>
@stack('scripts')
</body>
</html>
