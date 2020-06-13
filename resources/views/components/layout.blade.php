<!doctype html>
<html lang="pl">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    
    <meta name="description" content="{{ setting('general_page_description') }}">
    <meta name="tags" content="{{ setting('general_page_tags') }}">
    
    <title>@yield('title') - {{ setting('general_page_title') }}</title>
    
    <link rel="icon" type="image/png" href="{{ setting('general_page_favicon') }}">
    
    <link rel="stylesheet" href="{{ asset('/css/themes/' . setting('layout_theme') . '.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/css/fontawesome.min.css') }}">
    
    <style>
        body {
            background: url("{{ setting('general_page_background') }}") no-repeat center fixed;
        }
    </style>
</head>
<body>

    <div class="container">
        <header>
            <div class="logo-wrapper">
                <img class="img-fluid w-25" src="{{ setting('general_page_logo') }}" alt="{{ setting('general_page_title') . ' page logo' }}">
            </div>
            <nav class="navbar navbar-expand-lg navbar-dark bg-primary shadow">
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav mr-auto">
                        <li class="nav-item {{ Route::currentRouteName() === 'home' ? 'active' : '' }}">
                            <a class="nav-link" href="{{ route('home') }}">
                                <i class="fas fa-shopping-basket"></i> Sklep
                            </a>
                        </li>
                        
                        @foreach ($pages as $item)
                            <li class="nav-item {{ isset($page) ? ($page->getId() == $item->getId() ? 'active' : '') : '' }}">
                                <a class="nav-link" href="{{ $item->getType() == 'LINK' ? $item->getContent() : route('page', $item->getSlug()) }}">
                                    @if ($item->getIcon() != null)
                                        <i class="{{ $item->getIcon() }}"></i>
                                        {{ $item->getName() }}
                                    @endif
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </nav>
        </header>

        <main>
            @yield('announcement')
            
            <nav class="nav-breadcrumb shadow" aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">{{ setting('general_page_title') }}</a></li>
                    @yield('breadcrumb')
                </ol>
            </nav>
    
            @if (session('shopSessionMessage'))
                <div class="alert {{ 'alert-' . session('shopSessionMessage')['type'] }} alert-with-icon alert-dismissible fade show" role="alert">
                    <div class="alert-icon">
                        @if (session('shopSessionMessage')['type'] === 'success')
                            <i class="fas fa-check fa-fw"></i>
                        @elseif (session('shopSessionMessage')['type'] === 'danger' || session('shopSessionMessage')['type'] === 'warning')
                            <i class="fas fa-exclamation-triangle"></i>
                        @else
                            <i class="fas fa-info-circle"></i>
                        @endif
                    </div>
                    <p class="alert-message">{!! session('shopSessionMessage')['content'] !!}</p>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif

            @yield('content')
        </main>

        <footer>
            <div class="card shadow">
                <div class="card-body copy">
                    <span class="copyright">
                        Proudly powered by <a href="https://mcshop.io">MCShop Basic</a> {{ env('MCSHOP_VERSION') }}
                    </span>
                </div>
            </div>
        </footer>
    </div>
    
    @yield('modals')

    <script src="{{ mix('/js/bootstrap.min.js') }}"></script>
</body>
</html>
