<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
            <a href="/admin/dashboard" class="nav-link">Dashboard</a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
            <a href="{{ route('admin.classrooms.index') }}" class="nav-link">Classes</a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
            <a href="/admin/students" class="nav-link">Alunos</a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
            <a href="/admin/users" class="nav-link">Oficiais</a>
        </li>
    </ul>

    <a href="#" class="brand-link">

    </a>
    <ul class="navbar-nav ml-auto">
        <img src="{{ auth()->user()->avatar ? asset('storage/'.auth()->user()->avatar) : asset('storage/avatars/avatar.png') }}" alt="User Image" class="brand-image img-circle elevation-3" height="40" width="40"
             style="opacity: .8">
        <li class="nav-item dropdown">
            <a id="dropdownSubMenu1" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link dropdown-toggle">{{ auth()->user()->name }}</a>
            <ul aria-labelledby="dropdownSubMenu1" class="dropdown-menu border-0 shadow">
                <li><a href="#" class="dropdown-item">Minhas informações </a></li>

                <li class="dropdown-divider"></li>

                <form action="{{ route('logout') }}" method="post">
                    @csrf
                    <button type="submit" class="btn btn-link">
                        <i class="nav-icon fas fa-sign-out-alt"></i>
                        <span>Sair</span>
                    </button>
                </form>
            </ul>
        </li>
    </ul>
</nav>
