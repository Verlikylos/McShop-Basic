<aside class="col-12 col-md-3 col-lg-2">
    <div class="user-box">
        <a href="#" class="user-link">
            <img class="user-avatar" src="{{ Auth::user()->getAvatarUrl() }}" alt="{{ Auth::user()->getName() . '\'s avatar' }}">
            <span>{{ 'Witaj, ' . Auth::user()->getName() . '!' }}</span>
        </a>
    </div>
    <nav class="nav nav-pills nav-fill">
        <a class="nav-item nav-link {{ Route::currentRouteName() === 'admin.dashboard' ? 'active' : '' }}" href="{{ route('admin.dashboard') }}">
            <i class="fas fa-desktop fa-fw"></i> Pulpit
        </a>
        <a class="nav-item nav-link {{ Route::currentRouteName() === 'admin.users.index' ? 'active' : '' }}" href="{{ route('admin.users.index') }}">
            <i class="fas fa-users fa-fw"></i> Użytkownicy ACP
        </a>
        <a class="nav-item nav-link {{ Route::currentRouteName() === 'admin.servers.index' ? 'active' : '' }}" href="{{ route('admin.servers.index') }}">
            <i class="fas fa-server fa-fw"></i> Serwery
        </a>
        <a class="nav-item nav-link {{ Route::currentRouteName() === 'admin.services.index' ? 'active' : '' }}" href="{{ route('admin.services.index') }}">
            <i class="fas fa-cubes fa-fw"></i> Usługi
        </a>
        <a class="nav-item nav-link {{ Route::currentRouteName() === 'admin.vouchers.index' ? 'active' : '' }}" href="#">
            <i class="fas fa-ticket-alt fa-fw"></i> Vouchery
        </a>
        <a class="nav-item nav-link {{ Route::currentRouteName() === 'admin.pages.index' ? 'active' : '' }}" href="#">
            <i class="fas fa-file-code fa-fw"></i> Własne strony
        </a>
        <div class="nav-item">
            <hr />
        </div>
        <a class="nav-item nav-link" href="#">
            <i class="fas fa-history fa-fw"></i> Historia zakupów
        </a>
        <a class="nav-item nav-link" href="#">
            <i class="fas fa-database fa-fw"></i> Logi
        </a>
        <div class="nav-item">
            <hr />
        </div>
        <a class="nav-item nav-link {{ Route::currentRouteName() === 'admin.settings.index' ? 'active' : '' }}" href="{{ route('admin.settings.index') }}">
            <i class="fas fa-cogs"></i> Ustawienia strony
        </a>
    </nav>
</aside>
