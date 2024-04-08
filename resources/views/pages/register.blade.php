@extends('layouts.auth')

@push('styles')
    <link rel="stylesheet" href="{{asset('assets/client/css/register.css')}}">
@endpush


@section('content')
    <main class="form-signup">
        <form method="post" action="{{route('register')}}">
            @csrf
            <h1 class="h3 mb-3 fw-normal">Регистрация</h1>

            <div class="form-floating mt-3">
                <input name="name" type="text" class="form-control @error('name') is-invalid @enderror" id="name" placeholder="your name">
                <label for="name">Имя</label>
                @error('name')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>

            <div class="form-floating">
                <input name="email" type="email" class="form-control mt-3 @error('email') is-invalid @enderror" id="email" placeholder="name@example.com">
                <label for="email">Почта</label>
                @error('email')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>

            <div class="form-floating mt-3">
                <input name="password" type="password" class="form-control @error('password') is-invalid @enderror" id="password" placeholder="Password">
                <label for="password">Пароль</label>
                @error('password')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>

            <div class="form-floating mt-3">
                <input name="password_confirmation" type="password" class="form-control" id="passwordConfirmation" placeholder="Password repeat">
                <label for="passwordConfirmation">Подтвердите пароль</label>
            </div>
            <button class="w-100 btn btn-lg btn-primary mt-3" type="submit">Войти</button>
        </form>
    </main>
@endsection
