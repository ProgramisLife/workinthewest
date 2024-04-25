<link rel="stylesheet" href="{{ asset('assets/css/navbar.css') }}" />

<nav class="navbar navbar-expand-lg fixed-top navbar-scroll bg-primary" data-navbar-init>
    <div class="container-fluid">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarExample01">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarExample01">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <a class="navbar-brand" href="{{ route('jobs.index') }}">
                    <img src="{{asset('assets/images/logo.png') }}" class="img-fluid" alt="Logo">
                </a>
                <li class="nav-item text-uppercase">
                    <a class="nav-link text-light" aria-current="page" href="{{ route('jobs.index') }}">
                        strona główna
                    </a>
                </li>
                <li class="nav-item text-uppercase">
                    <a class="nav-link text-light" aria-current="page" href="">strefa
                        pracodawcy</a>
                </li>
                <li class="nav-item text-uppercase">
                    <a class="nav-link text-light" aria-current="page" href="">strefa
                        pracownika</a>
                </li>
                <li class="nav-item text-uppercase">
                    <a class="nav-link text-light" aria-current="page" href="{{ route('jobs.search') }}">oferty
                        pracy</a>
                </li>
                <li class="nav-item text-uppercase">
                    <a class="nav-link text-light" aria-current="page"
                        href="{{ route('accommodation.index') }}">zakwaterowanie
                    </a>
                </li>
                <li class="nav-item text-uppercase">
                    <a class="nav-link text-light" aria-current="page"
                        href="{{ route('accommodation.index') }}">pracodawca
                    </a>
                </li>
                <li class="nav-item text-uppercase">
                    <a class="nav-link text-light" aria-current="page" href="{{ route('articles.index') }}">artykuły
                    </a>
                </li>
            </ul>
            <ul class="navbar-nav flex-row">
                <!-- Icons -->
                <li class="nav-item">
                    <a class="btn btn-lg btn-success" href="{{ route('jobs.add') }}" rel="nofollow">
                        <i class="bi bi-pencil-square"></i>
                    </a>
                </li>
                <div class="dropdown">
                    <button class="btn border-primary dropdown-toggle" type="button" id="dropdownMenu2"
                        data-bs-toggle='dropdown'>
                        polski
                    </button>
                    <div class="dropdown-menu">
                        <button class="dropdown-item" type="button">angielski</button>
                        <button class="dropdown-item" type="button">rosyjski</button>
                        <button class="dropdown-item" type="button">ukraiński</button>
                    </div>
                </div>
            </ul>
        </div>
    </div>
</nav>