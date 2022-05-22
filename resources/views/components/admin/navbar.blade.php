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
        <li class="nav-item d-none d-sm-inline-block">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="nav-link btn btn-link">Sair</button>
            </form>
        </li>
    </ul>
</nav>
