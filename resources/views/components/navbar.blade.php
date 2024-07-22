<nav class="navbar navbar-expand-lg bg-light">
    <div class="container">
        <a class="navbar-brand text-primary fw-bold fs-4" href="#">PCE</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-lg-0">
                <li class="nav-item">
                    <a class="{{ request()->is('dashboard') ? 'active fw-bold' : '' }} nav-link"
                        href="{{ route('dashboard') }}">Dashboard</a>
                </li>
                <li class="nav-item">
                    <a class="{{ request()->is('mall') || request()->is('mall/*') ? 'active fw-bold' : '' }} nav-link"
                        href="{{ route('mall.index') }}">Mall</a>
                </li>
                <li class="nav-item">
                    <a class="{{ request()->is('users') ? 'active fw-bold' : '' }} nav-link"
                        href="{{ route('users.index') }}">Pengguna</a>
                </li>
            </ul>
            <div class="d-flex">
                <a href="logout" title="Keluar Aplikasi" class="btn btn-danger btn-sm"><i
                        class="fa-solid fa-power-off"></i></a>
            </div>
        </div>
    </div>
</nav>
