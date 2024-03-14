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
        <form method="get" action="">
            <h1 class="h3 mb-3 fw-normal">Войти</h1>

            <div class="form-floating">
                <input type="email" class="form-control" id="floatingInput" placeholder="name@example.com">
                <label for="floatingInput">Почта</label>
            </div>
            <div class="form-floating mt-3">
                <input type="password" class="form-control" id="floatingPassword" placeholder="Password">
                <label for="floatingPassword">Пароль</label>
            </div>
            <button class="w-100 btn btn-lg btn-primary mt-3" type="submit">Войти</button>
        </form>
    </main>
</div>

<script src="{{asset('js/bootstrap.js')}}"></script>
</body>

</html>
