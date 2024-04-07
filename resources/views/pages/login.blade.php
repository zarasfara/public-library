<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{asset('css/bootstrap.css')}}">
    <link rel="stylesheet" href="{{asset('css/login.css')}}">
    <title>Document</title>
</head>

<body>
<div class="container">
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
</div>

<script src="{{asset('js/bootstrap-5.js')}}"></script>
</body>

</html>
