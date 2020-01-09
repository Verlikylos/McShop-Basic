<!doctype html>
<html lang="pl">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="stylesheet" href="{{ mix('/css/themes/vmcshop.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/css/fontawesome.min.css') }}">
    @if (isset($withJasnyBootstrap) && $withJasnyBootstrap)
        <link rel="stylesheet" href="{{ asset('/css/jasny-bootstrap.min.css') }}">
    @endif

    <title>vMCShop Basic - @yield('title')</title>
</head>
<body class="acp">

<header class="shadow-sm">
    <div class="logo-wrapper">
        <img class="img-fluid mx-auto" src="{{ asset('images/logo.png') }}" alt="Page Logo">
    </div>
</header>

<div class="container position-relative">
    <div class="acp-raised-card shadow">
        @if (isset($withoutSidebar) && $withoutSidebar)
            <main>
                @yield('content')
            </main>
        @else
            <div class="row">

                @include('admin.components.sidebar')

                <main class="col-12 col-md-9 col-lg-10">
                    <div class="acp-card-header">
                        @yield('acp-card-title')
                    </div>

                    @if (session('sessionMessage'))
                        <div class="alert {{ 'alert-' . session('sessionMessage')['type'] }} alert-with-icon alert-dismissible fade show" role="alert">
                            <div class="alert-icon">
                                @if (session('sessionMessage')['type'] === 'success')
                                    <i class="fas fa-check fa-fw"></i>
                                @elseif (session('sessionMessage') === 'danger')
                                    <i class="fas fa-exclamation-triangle"></i>
                                @else
                                    <i class="fas fa-info-circle"></i>
                                @endif
                            </div>
                            <p class="alert-message">{!! session('sessionMessage')['content'] !!}</p>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif

                    @yield('content')
                </main>
            </div>
        @endif
    </div>

    <footer>
        <a href="{{ route('home') }}">
            <i class="fas fa-arrow-left"></i> Przejdź do sklepu
        </a>
        <span class="copyright">
            Proudly powered by <a href="https://mcshop.io/">MCShop Basic</a> {{ env('MCSHOP_VERSION') }}
        </span>
    </footer>
</div>

@yield('modals')

<script src="{{ mix('/js/bootstrap.min.js') }}"></script>
@if (isset($withJasnyBootstrap) && $withJasnyBootstrap)
    <script src="{{ asset('/js/jasny-bootstrap.min.js') }}"></script>
@endif
</body>
</html>
