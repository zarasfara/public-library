<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{asset('css/bootstrap.css')}}">
    @stack('style sheets')
    <title>Document</title>
</head>

<body>
<div class="container">
    @include('components.header')
    @yield('content')
</div>

<script src="{{asset('js/bootstrap.js')}}"></script>
@stack('scripts')
</body>
</html>
