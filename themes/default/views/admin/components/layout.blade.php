<!doctype html>
<html lang="pl">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <meta name="description" content="{{ setting('general_page_description') }}">
    <meta name="tags" content="{{ setting('general_page_tags') }}">

    <title>@yield('title') - {{ setting('general_page_title') }}</title>

    <link rel="icon" type="image/png" href="{{ setting('general_page_favicon') }}">

    <link rel="stylesheet" href="{{ mix('/css/themes/' . setting('layout_theme') . '.css') }}">
    <link rel="stylesheet" href="{{ asset('/css/fontawesome.css') }}">
    <link rel="stylesheet" href="{{ asset('/css/simplemde.min.css') }}">

    <style>
        .logo-wrapper {
            background: url("{{ setting('general_page_background') }}") no-repeat center fixed;
        }
    </style>
</head>
<body class="acp">

<nav class="navbar fixed-top navbar-expand navbar-dark bg-primary shadow">
    <div class="container-fluid">
        <a class="navbar-brand sidenav-navbar-brand" href="#">McShop.io</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse flex-row-reverse flex-md-row" id="navbarSupportedContent">
            <ul class="navbar-nav mr-md-auto mb-lg-0">
                <li class="nav-item">
                    <button id="toggleSidenav" class="btn btn-sm btn-success">
                        <i class="fas fa-bars fa-fw"></i>
                    </button>
                </li>
            </ul>
            <ul class="navbar-nav ml-md-auto">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle d-flex align-items-center" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-expanded="false">
                        <span class="d-none d-md-inline">Verlikylos</span>
                        <div class="avatar avatar-online ml-2 mr-1">
                            <img class="avatar-img img-fluid" src="https://verlikylos.dev/static/avatar-7ba0d5b7025cbb87ffe7108d01a5a67d.jpg" alt="avatar img">
                        </div>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-left" aria-labelledby="navbarDropdown">
                        <li>
                            <a class="dropdown-item" href="#">
                                <i class="fas fa-user"></i>
                                Profil
                            </a>
                        </li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li>
                            <a class="dropdown-item" href="#">
                                <i class="fas fa-sign-out-alt"></i>
                                Wyloguj
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>

<div class="layout-wrapper">
    <div class="layout-sidenav">
        @include ('admin.components.sidenav')
    </div>
    <div class="layout-content" aria-live="polite" aria-atomic="true">
        @if (session('sessionMessage'))
            <div class="toast bg-success" data-autohide="{{ (isset(session('sessionMessage')['autohide']) && !session('sessionMessage')['autohide']) ? 'false' : 'true' }}">
                <div class="toast-header">
                    <span>
                        <i class="fas fa-check"></i>
                        Sukces!
                    </span>
                    <button type="button" class="close" data-dismiss="toast" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="toast-body">
                    {!! session('sessionMessage')['content'] !!}
                </div>
            </div>
        @endif
        <div class="wrapper">
            <header>
                <div class="container d-flex align-items-center justify-content-between">
                    @yield ('acp-card-title')
                </div>
            </header>
            <main>
                <div class="container">
                    @if (isset($withoutContentCard) && $withoutContentCard)
                        @yield ('content')
                    @else
                        <div class="card">
                            <div class="card-body shadow">
                                @yield ('content')
                            </div>
                        </div>
                    @endif
                </div>
            </main>
        </div>
        <footer>
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12 col-md-6 small">
                        <nav>
                            <ul class="nav">
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('home') }}">
                                        <i class="fas fa-arrow-left"></i>
                                        Przejdź do sklepu
                                    </a>
                                </li>
                            </ul>
                        </nav>
                    </div>
                    <div class="col-12 col-md-6 small text-md-right">
                    <span>
                        Proudly powered by <a href="https://mcshop.io/">McShop Basic</a> {{ env('MCSHOP_VERSION') }}
                    </span>
                    </div>
                </div>
            </div>
        </footer>
    </div>
</div>

@yield('modals')

<script src="{{ mix('/js/bootstrap.js') }}"></script>

@yield('scripts')
</body>
</html>
