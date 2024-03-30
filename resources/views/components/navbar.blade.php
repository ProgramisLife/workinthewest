<link rel="stylesheet" href="{{ asset('assets/css/navbar.css') }}" />
<div class="navigation col-12 w-100 fixed-top bg-primary">
    <div class="container">
        <nav class="navbar navbar-expand-lg">
            <div class="container-fluid">
                <a class="navbar-brand" href="{{ route('jobs.index') }}">
                    <img src="{{asset('assets/images/logo.png') }}" class="img-fluid" alt="Logo">
                </a>
                <div class="d-flex">
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                </div>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link text-light" href="{{ route('jobs.index') }}">STRONA GŁÓWNA</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-light" href="{{ route('jobs.search') }}">STREFA PRACODAWCY</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-light" href="#">STREFA PRACOWNIKA</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-light" href="#">OFERTY PRACY</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-light" href="#">ZAKWATEROWANIE</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-light" href="#">PRACODAWCA</a>
                        </li>
                    </ul>
                    <div class="button">
                        <a class="btn btn-lg btn-success" href="{{ route('jobs.add') }}">
                            <i class="bi bi-pencil-square"></i>
                        </a>
                    </div>
                    <div class="dropdown">
                        <button class="btn border-primary dropdown-toggle" type="button" id="dropdownMenu2" data-bs-toggle='dropdown'>
                            polski
                        </button>
                        <div class="dropdown-menu">
                            <button class="dropdown-item" type="button">angielski</button>
                            <button class="dropdown-item" type="button">rosyjski</button>
                            <button class="dropdown-item" type="button">ukraiński</button>
                        </div>
                    </div>
                </div>
            </div>
        </nav>
    </div>
</div>