<!doctype html>
<html lang="pl">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    
    <link rel="stylesheet" href="{{ mix('/css/themes/vmcshop.css') }}">
    <link rel="stylesheet" href="{{ asset('/css/fontawesome.css') }}">
    
    <title>vMCShop Basic - @yield('title')</title>
</head>
<body>

    <div class="container">
        <header>
            <div class="logo-wrapper">
                <img class="img-fluid" src="{{ asset('images/logo.png') }}" alt="Page Logo">
            </div>
            <nav class="navbar navbar-expand-lg navbar-dark bg-primary shadow">
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
        
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav mr-auto">
                        <li class="nav-item active">
                            <a class="nav-link" href="{{ route('home') }}">
                                <i class="fas fa-shopping-basket"></i> Sklep
                            </a>
                        </li>
                    </ul>
                </div>
            </nav>
        </header>
        
        <main>
            <nav class="nav-breadcrumb shadow" aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item"><a href="#">Library</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Data</li>
                </ol>
            </nav>
    
            @yield('content')
        </main>
        
        <footer>
            <div class="card shadow">
                <div class="card-body copy">
                    <span class="copyright">
                        Proudly powered by <a href="https://vmcshop.pro">vMCShop Basic</a> v2.0.0-beta.1
                    </span>
                </div>
            </div>
        </footer>
    </div>

    <script src="{{ mix('/js/bootstrap.js') }}"></script>
</body>
</html>
