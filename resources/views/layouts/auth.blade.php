<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{asset('assets/client/css/bootstrap-5.css')}}">
    @stack('styles')
    <title>Регистрация</title>
</head>

<body>
<div class="container">
    @yield('content')
</div>

<script src="{{asset('assets/client/js/bootstrap-5.js')}}"></script>
@stack('scripts')
</body>

</html>
