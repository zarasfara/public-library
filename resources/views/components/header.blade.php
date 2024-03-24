<header
    class="d-flex flex-wrap align-items-center justify-content-center justify-content-md-between py-3 mb-4 border-bottom">

    <ul class="nav col-12 col-md-auto mb-2 justify-content-center mb-md-0">
        <li><a href="/" class="nav-link px-2 {{ request()->is('/') ? 'link-secondary' : 'link-dark' }}">Главная</a></li>
         @auth
        <li><a href="{{ route('dashboard') }}" class="nav-link px-2 {{ request()->is('dashboard') ? 'link-secondary' : 'link-dark' }}">Личный кабинет</a></li>
         @endauth
    </ul>

    <div class="col-md-3 text-end">
        @guest
            <a href="{{route('login.form')}}" type="button" class="btn btn-outline-primary me-2">Войти</a>
            <a href="{{route('register.form')}}" class="btn btn-primary">Регистрация</a>
        @endguest
        @auth
            <form id="logout-form" action="{{ route('logout') }}" method="POST">
                @csrf

                <button type="submit" type="button" class="btn btn-primary">Выход</button>
            </form>
        @endauth
    </div>
</header>
