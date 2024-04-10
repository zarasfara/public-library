@extends('layouts.auth')

@push('styles')
    <link rel="stylesheet" href="{{asset('assets/client/css/login.css')}}">
@endpush

@section('content')

    <main class="form-signin">
        <form method="post" action="{{route('login')}}">
            @csrf
            <h1 class="h3 mb-3 fw-normal">Войти</h1>

            <div class="form-floating">
                <input name="email" type="email" class="form-control" id="email" placeholder="name@example.com">
                <label for="email">Почта</label>
            </div>
            <div class="form-floating mt-3">
                <input name="password" type="password" class="form-control" id="password" placeholder="Password">
                <label for="password">Пароль</label>
            </div>
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <button class="w-100 btn btn-lg btn-primary mt-3" type="submit">Войти</button>
        </form>
        <p class="mt-3">Нет аккаунта? <a href="{{ route('register') }}">Создать</a></p>
    </main>

@endsection
