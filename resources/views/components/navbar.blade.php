<header>
    <!-- Custom CSS Style -->
    <link rel="stylesheet" href="{{ asset('assets/css/shared/main.css') }}" type="text/css" />
    <link rel="stylesheet" href="{{ asset('assets/css/shared/navbar.css') }}" />
</header>

<!-- Navbar -->
<nav class="navbar navbar-expand-xl sticky-top background-main">
    <div class="container-fluid">
        <a class="navbar-brand mx-3" href="{{ route('jobs.index') }}">
            <img src="{{asset('assets/images/logo.png') }}" alt="Logo">
        </a>
        <div class="collapse navbar-collapse" id="navbarContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item text-uppercase">
                    <a class="nav-link text-white" aria-current="page" href="{{ route('jobs.index') }}">
                        strona główna
                    </a>
                </li>
                <li class="nav-item text-uppercase">
                    <a class="nav-link text-white" aria-current="page" href="">strefa
                        pracodawcy</a>
                </li>
                <li class="nav-item text-uppercase">
                    <a class="nav-link text-white" aria-current="page" href="">strefa
                        pracownika</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle text-uppercase text-white" href="#" id="navbarDropdown"
                        role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        panel kandydata
                    </a>
                    <ul class="dropdown-menu navbar-bg-main" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item text-white navbar-bg-main" href="#">Mój profil</a></li>
                        <li><a class="dropdown-item text-white navbar-bg-main" href="#">Złożone aplikacje</a></li>
                        <li><a class="dropdown-item text-white navbar-bg-main" href="#">Obserwowani pracodawcy</a></li>
                        <li><a class="dropdown-item text-white navbar-bg-main" href="#">Zapisane aplikacje</a></li>
                        <li><a class="dropdown-item text-white navbar-bg-main" href="#">Powiadomienia</a></li>>
                        <li><a class="dropdown-item text-white navbar-bg-main" href="#">Opinie</a></li>
                    </ul>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle text-uppercase text-white" href="#" id="navbarDropdown"
                        role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        panel pracodawcy
                    </a>
                    <ul class="dropdown-menu navbar-bg-main" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item text-white navbar-bg-main" href="#">Mój profil</a></li>
                        <li><a class="dropdown-item text-white navbar-bg-main" href="#">Dodaj ofertę</a></li>
                        <li><a class="dropdown-item text-white navbar-bg-main" href="#">Moje oferty</a></li>
                        <li><a class="dropdown-item text-white navbar-bg-main" href="#">Oferty aplikacyjne</a></li>
                        <li><a class="dropdown-item text-white navbar-bg-main" href="#">Pakiet ofert</a></li>
                        <li><a class="dropdown-item text-white navbar-bg-main" href="#">Pakiety kandydatów</a></li>
                        <li><a class="dropdown-item text-white navbar-bg-main" href="#">Przeglądane życiorysy</a></li>
                        <li><a class="dropdown-item text-white navbar-bg-main" href="#">Opinie</a></li>
                    </ul>
                </li>
                <li class="nav-item text-uppercase">
                    <a class="nav-link text-white" aria-current="page" href="{{ route('jobs.search') }}">oferty
                        pracy</a>
                </li>
                <li class="nav-item text-uppercase">
                    <a class="nav-link text-white" aria-current="page"
                        href="{{ route('accommodations.index') }}">zakwaterowanie
                    </a>
                </li>
                <li class="nav-item text-uppercase">
                    <a class="nav-link text-white" aria-current="page"
                        href="{{ route('accommodations.index') }}">pracodawca
                    </a>
                </li>
                <li class="nav-item text-uppercase">
                    <a class="nav-link text-white" aria-current="page" href="{{ route('articles.index') }}">artykuły
                    </a>
                </li>
            </ul>
        </div>
        <div class="d-flex justify-content-end no-wrap">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="btn btn btn-success" href="{{ route('jobs.add') }}" rel="nofollow">
                        <i class="bi bi-pencil-square p-2"></i>
                    </a>
                </li>
            </ul>
            <button class="navbar-toggler border-white" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarContent">
                <span class="navbar-toggler-icon"></span>
            </button>
        </div>
    </div>
</nav>