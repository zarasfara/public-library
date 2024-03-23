<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{asset('css/bootstrap.css')}}">
    <link rel="stylesheet" href="{{asset('css/register.css')}}">
    <title>Регистрация</title>
</head>

<body>
<div class="container">
    <main class="form-signup">
        <form method="post" action="{{route('register')}}">
            @csrf
            <h1 class="h3 mb-3 fw-normal">Регистрация</h1>

            <div class="form-floating mt-3">
                <input name="name" type="text" class="form-control" id="name" placeholder="your name">
                <label for="name">Имя</label>
            </div>

            <div class="form-floating">
                <input name="email" type="email" class="form-control mt-3" id="email" placeholder="name@example.com">
                <label for="email">Почта</label>
            </div>

            <div class="form-floating mt-3">
                <input name="password" type="password" class="form-control" id="password" placeholder="Password">
                <label for="password">Пароль</label>
            </div>

            <div class="form-floating mt-3">
                <input name="password_confirmation" type="password" class="form-control" id="passwordConfirmation" placeholder="Password repeat">
                <label for="passwordConfirmation">Подтвердите пароль</label>
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
    </main>
</div>

<script src="{{asset('js/bootstrap.js')}}"></script>
</body>

</html>
