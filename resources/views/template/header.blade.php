@php
    $user = Auth::user();
@endphp

<header id="page-topbar">
    <div class="layout-width">
        <div class="navbar-header">
            <div class="d-flex">
                <div class="navbar-brand-box horizontal-logo"></div>

                <button type="button" class="btn btn-sm px-3 fs-16 header-item vertical-menu-btn topnav-hamburger" id="topnav-hamburger-icon">
                    <span class="hamburger-icon">
                        <span></span>
                        <span></span>
                        <span></span>
                    </span>
                </button>
            </div>

            <div class="d-flex align-items-center">
                <div class="ms-1 header-item d-none d-sm-flex">
                    <button type="button" class="btn btn-icon btn-topbar btn-ghost-secondary rounded-circle" data-toggle="fullscreen">
                        <i class='bx bx-fullscreen fs-22'></i>
                    </button>
                </div>

                <div class="ms-1 header-item d-none d-sm-flex">
                    <button type="button" class="btn btn-icon btn-topbar btn-ghost-secondary rounded-circle light-dark-mode">
                        <i class='bx bx-moon fs-22'></i>
                    </button>
                </div>

                <div class="dropdown ms-sm-3 header-item topbar-user">
                    <button type="button" class="btn" id="page-header-user-dropdown" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <span class="d-flex align-items-center">
                            <img class="rounded-circle header-profile-user" src="{{ asset('assets/profile.jpeg') }}" alt="Header Avatar">
                            <span class="text-start ms-xl-2">
                                <span class="d-none d-xl-inline-block ms-1 fw-medium user-name-text">{{ $user->name }} <br> Nirm : 2019020918</span>
                            </span>
                        </span>
                    </button>
                    <div class="dropdown-menu dropdown-menu-end">
                        <h6 class="dropdown-header">Selamat Datang {{ $user->name }}!</h6>
                        <a class="dropdown-item" href="{{ URL::to('logout') }}"><i class="mdi mdi-logout text-muted fs-16 align-middle me-1"></i> <span class="align-middle" data-key="t-logout">Logout</span></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>

<div class="app-menu navbar-menu">
    <div class="navbar-brand-box">
        <button type="button" class="btn btn-sm p-0 fs-20 header-item float-end btn-vertical-sm-hover" id="vertical-hover">
            <i class="ri-record-circle-line"></i>
        </button>
    </div>

    <div id="scrollbar">
        <div class="container-fluid">
            <div id="two-column-menu"></div>
            <ul class="navbar-nav" id="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link menu-link @if($title == 'Home') active @endif" href="{{ URL::to('home') }}">
                        <i class="bx bxs-dashboard"></i> <span data-key="t-home">Home</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link menu-link @if($title == 'Gejala') active @endif" href="{{ URL::to('gejala') }}">
                        <i class="bx bxs-dashboard"></i> <span data-key="t-Gejala">gejala</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link menu-link @if($title == 'Penyakit') active @endif" href="{{ URL::to('penyakit') }}">
                        <i class="bx bxs-dashboard"></i> <span data-key="t-penyakit">Penyakit</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link menu-link @if($title == 'Basis Pengetahuan') active @endif" href="{{ URL::to('basis_pengetahuan') }}">
                        <i class="bx bxs-dashboard"></i> <span data-key="t-Basis-Pengetahuan">Basis Pengetahuan</span>
                    </a>
                </li>
            </ul>
        </div>
    </div>
    <div class="sidebar-background"></div>
</div>
