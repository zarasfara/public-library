<header
    class="d-flex flex-wrap align-items-center justify-content-center justify-content-md-between py-3 mb-4 border-bottom">

    <ul class="nav col-12 col-md-auto mb-2 justify-content-center mb-md-0">
        <li><a href="#" class="nav-link px-2 link-secondary">Главная</a></li>
        <li><a href="#" class="nav-link px-2 link-dark">Другая страница</a></li>
    </ul>

    <div class="col-md-3 text-end">
        @guest
            <a href="{{route('login')}}" type="button" class="btn btn-outline-primary me-2">Войти</a>
            <button type="button" class="btn btn-primary">Регистрация</button>
        @endguest
    </div>
</header>
