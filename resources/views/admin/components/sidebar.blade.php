<aside class="main-sidebar main-sidebar-custom sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{route('admin.index')}}" class="brand-link">
        <img src="{{asset('assets/admin/images/AdminLTELogo.png')}}" alt="AdminLTE Logo"
             class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">Админ-панель</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="info">
                <a href="#" class="d-block">{{Auth::user()->name}}</a>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
                     with font-awesome or any other icon font library -->
                <li class="nav-item">
                    <a href="{{route('books.index')}}" class="nav-link">
                        <i class="nav-icon fas fa-book"></i>
                        <p>
                            Книжный фонд
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{route('authors.index')}}" class="nav-link">
                        <i class="nav-icon fas fa-pen"></i>
                        <p>
                            Авторы
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{route('checkouts.index')}}" class="nav-link">
                        <i class="nav-icon fas fa-edit"></i>
                        <p>
                            Оформления
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{route('visitors.stats')}}" class="nav-link">
                        <i class="fa fa-users" aria-hidden="true"></i>
                        <p>
                            Прогнозы посещений
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{route('meta-tags.index')}}" class="nav-link">
                        <i class="nav-icon fas fa-chart-line"></i>
                        <p>
                            Продвижение сайта
                        </p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{route('genres.index')}}" class="nav-link">
                        <i class="fa fa-bookmark" aria-hidden="true"></i>
                        <p>
                            Жанры
                        </p>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->

    <div class="sidebar-custom">
        <a href="#" class="btn btn-link"><i class="fas fa-cogs"></i></a>
    </div>
    <!-- /.sidebar-custom -->
</aside>
