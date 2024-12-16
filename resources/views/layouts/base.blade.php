<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    @isset($meta)
        <meta name="description" content="{{ $meta->description }}">
        <meta name="keywords" content="{{ $meta->keywords }}">
        <meta name="robots" content="{{ $meta->robots }}">
    @endisset

    <title>{{$meta->title ?? "Application"}} - @yield('title')</title>

    <link rel="stylesheet" href="{{asset('assets/client/css/bootstrap-5.css')}}">
    <link rel="stylesheet" href="{{asset('assets/common/toastr/toastr.min.css')}}">

    @stack('style sheets')
</head>

<body>
<main class="container">
    @include('components.header')
    @yield('content')
</main>

<script src="{{asset('assets/client/js/bootstrap-5.js')}}"></script>
<script src="{{asset('assets/jquery/jquery.min.js')}}"></script>
<script src="{{asset('assets/common/toastr/toastr.min.js')}}"></script>
<script>
    $(document).ready(function () {
        toastr.options = {
            "closeButton": true,
            "progressBar": true,
            "positionClass": "toast-bottom-right",
            "timeOut": "5000"
        };
        @if (session('success'))
            toastr["success"]("{{ session('success') }}");
        @endif
            @if (session('error'))
            toastr["error"]("{{ session('error') }}");
        @endif
    });
</script>


@stack('scripts')
</body>
</html>
