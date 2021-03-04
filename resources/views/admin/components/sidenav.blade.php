<nav class="sidenav shadow-right">
    <div class="sidenav-menu">
        <div class="nav accordion mt-4" id="accordionSidenav">
            <a class="nav-link {{ Route::currentRouteName() === 'admin.dashboard' ? 'active' : '' }}" href="{{ route('admin.dashboard') }}">
                <div class="nav-link-icon">
                    <i class="fas fa-desktop fa-lg fa-fw"></i>
                </div>
                Pulpit
            </a>
            <div class="sidenav-menu-heading">Administracja</div>
            <a
                class="nav-link {{ (!in_array(Route::currentRouteName(), ['admin.users.index', 'admin.users.create'])) ? 'collapsed' : '' }}"
                href="javascript:void(0);" data-toggle="collapse" data-target="#collapseUsers"
                aria-expanded="{{ in_array(Route::currentRouteName(), ['admin.users.index', 'admin.users.create']) ? 'true' : 'false' }}" aria-controls="collapseUsers"
            >
                <div class="nav-link-icon">
                    <i class="fas fa-users fa-lg fa-fw"></i>
                </div>
                Użytkownicy ACP
                <div class="sidenav-collapse-arrow">
                    <i class="fas fa-angle-down"></i>
                </div>
            </a>
            <div class="collapse {{ in_array(Route::currentRouteName(), ['admin.users.index', 'admin.users.create']) ? 'show' : '' }}" id="collapseUsers" data-parent="#accordionSidenav">
                <nav class="sidenav-menu-nested nav accordion" id="accordionSidenavUsersMenu">
                    <a class="nav-link {{ Route::currentRouteName() == 'admin.users.index' ? 'active' : '' }}" href="{{ route('admin.users.index') }}">
                        <div class="nav-link-icon">
                            <i class="fas fa-list-ul fa-lg fa-fw"></i>
                        </div>
                        Lista użytkowników
                    </a>
                    <a class="nav-link {{ Route::currentRouteName() == 'admin.users.create' ? 'active' : '' }}" href="{{ route('admin.users.create') }}">
                        <div class="nav-link-icon">
                            <i class="fas fa-plus-square fa-lg fa-fw"></i>
                        </div>
                        Dodaj użytkownika
                    </a>
                </nav>
            </div>
            <a
                class="nav-link {{ (!in_array(Route::currentRouteName(), ['admin.servers.index', 'admin.servers.create'])) ? 'collapsed' : '' }}"
                href="javascript:void(0);" data-toggle="collapse" data-target="#collapseServers"
                aria-expanded="{{ in_array(Route::currentRouteName(), ['admin.servers.index', 'admin.servers.create']) ? 'true' : 'false' }}" aria-controls="collapseServers"
            >
                <div class="nav-link-icon">
                    <i class="fas fa-server fa-lg fa-fw"></i>
                </div>
                Serwery
                <div class="sidenav-collapse-arrow">
                    <i class="fas fa-angle-down"></i>
                </div>
            </a>
            <div class="collapse {{ in_array(Route::currentRouteName(), ['admin.servers.index', 'admin.servers.create']) ? 'show' : '' }}" id="collapseServers" data-parent="#accordionSidenav">
                <nav class="sidenav-menu-nested nav accordion" id="accordionSidenavServersMenu">
                    <a class="nav-link {{ Route::currentRouteName() == 'admin.servers.index' ? 'active' : '' }}" href="{{ route('admin.servers.index') }}">
                        <div class="nav-link-icon">
                            <i class="fas fa-list-ul fa-lg fa-fw"></i>
                        </div>
                        Lista serwerów
                    </a>
                    <a class="nav-link {{ Route::currentRouteName() == 'admin.servers.create' ? 'active' : '' }}" href="{{ route('admin.servers.create') }}">
                        <div class="nav-link-icon">
                            <i class="fas fa-plus-square fa-lg fa-fw"></i>
                        </div>
                        Dodaj serwer
                    </a>
                </nav>
            </div>
            <a
                class="nav-link {{ (!in_array(Route::currentRouteName(), ['admin.services.index', 'admin.services.create'])) ? 'collapsed' : '' }}"
                href="javascript:void(0);" data-toggle="collapse" data-target="#collapseServices"
                aria-expanded="{{ in_array(Route::currentRouteName(), ['admin.services.index', 'admin.services.create']) ? 'true' : 'false' }}" aria-controls="collapseServices"
            >
                <div class="nav-link-icon">
                    <i class="fas fa-cubes fa-lg fa-fw"></i>
                </div>
                Usługi
                <div class="sidenav-collapse-arrow">
                    <i class="fas fa-angle-down"></i>
                </div>
            </a>
            <div class="collapse {{ in_array(Route::currentRouteName(), ['admin.services.index', 'admin.services.create']) ? 'show' : '' }}" id="collapseServices" data-parent="#accordionSidenav">
                <nav class="sidenav-menu-nested nav accordion" id="accordionSidenavServicesMenu">
                    <a
                        class="nav-link  {{ Route::currentRouteName() != 'admin.services.index' ? 'collapsed' : '' }}"
                        href="javascript:void(0);" data-toggle="collapse" data-target="#collapseServerServices"
                        aria-expanded=" {{ Route::currentRouteName() == 'admin.services.index' ? 'true' : 'false' }}" aria-controls="collapseServerServices"
                    >
                        <div class="nav-link-icon">
                            <i class="fas fa-list-ul fa-lg fa-fw"></i>
                        </div>
                        Lista usług
                        <div class="sidenav-collapse-arrow">
                            <i class="fas fa-angle-down"></i>
                        </div>
                    </a>
                    <div class="collapse {{ Route::currentRouteName() == 'admin.services.index' ? 'show' : '' }}" id="collapseServerServices" data-parent="#accordionSidenavServicesMenu">
                        <nav class="sidenav-menu-nested nav accordion" id="accordionSidenavServerServicesMenu">
                            @foreach ($navServers as $navServer)
                                <a class="nav-link {{ (isset($activeServer) && ($activeServer->getId() == $navServer->getId())) ? 'active' : '' }}" href="{{ route('admin.services.index', $navServer->getSlug()) }}">
                                    <div class="nav-link-icon">
                                        <i class="fas fa-server fa-lg fa-fw"></i>
                                    </div>
                                    Serwer {{ $navServer->getName() }}
                                </a>
                            @endforeach
                        </nav>
                    </div>
                    <a class="nav-link {{ Route::currentRouteName() == 'admin.services.create' ? 'active' : '' }}" href="{{ route('admin.services.create') }}">
                        <div class="nav-link-icon">
                            <i class="fas fa-plus-square fa-lg fa-fw"></i>
                        </div>
                        Dodaj usługę
                    </a>
                </nav>
            </div>
            <a
                class="nav-link {{ (!in_array(Route::currentRouteName(), ['admin.vouchers.index', 'admin.vouchers.create'])) ? 'collapsed' : '' }}"
                href="javascript:void(0);" data-toggle="collapse" data-target="#collapseVouchers"
                aria-expanded="{{ in_array(Route::currentRouteName(), ['admin.vouchers.index', 'admin.vouchers.create']) ? 'true' : 'false' }}" aria-controls="collapseVouchers"
            >
                <div class="nav-link-icon">
                    <i class="fas fa-ticket-alt fa-lg fa-fw"></i>
                </div>
                Vouchery
                <div class="sidenav-collapse-arrow">
                    <i class="fas fa-angle-down"></i>
                </div>
            </a>
            <div class="collapse {{ in_array(Route::currentRouteName(), ['admin.vouchers.index', 'admin.vouchers.create']) ? 'show' : '' }}" id="collapseVouchers" data-parent="#accordionSidenav">
                <nav class="sidenav-menu-nested nav accordion" id="accordionSidenavVouchersMenu">
                    <a class="nav-link {{ Route::currentRouteName() == 'admin.vouchers.index' ? 'active' : '' }}" href="{{ route('admin.vouchers.index') }}">
                        <div class="nav-link-icon">
                            <i class="fas fa-list-ul fa-lg fa-fw"></i>
                        </div>
                        Lista voucherów
                    </a>
                    <a class="nav-link {{ Route::currentRouteName() == 'admin.vouchers.create' ? 'active' : '' }}" href="{{ route('admin.vouchers.create') }}">
                        <div class="nav-link-icon">
                            <i class="fas fa-cogs fa-lg fa-fw"></i>
                        </div>
                        Generator voucherów
                    </a>
                </nav>
            </div>
            <a
                class="nav-link {{ (!in_array(Route::currentRouteName(), ['admin.pages.index', 'admin.pages.create'])) ? 'collapsed' : '' }}"
                href="javascript:void(0);" data-toggle="collapse" data-target="#collapsePages"
                aria-expanded="{{ in_array(Route::currentRouteName(), ['admin.pages.index', 'admin.pages.create']) ? 'true' : 'false' }}" aria-controls="collapsePages"
            >
                <div class="nav-link-icon">
                    <i class="fas fa-file-code fa-lg fa-fw"></i>
                </div>
                Własne strony
                <div class="sidenav-collapse-arrow">
                    <i class="fas fa-angle-down"></i>
                </div>
            </a>
            <div class="collapse {{ in_array(Route::currentRouteName(), ['admin.pages.index', 'admin.pages.create']) ? 'show' : '' }}" id="collapsePages" data-parent="#accordionSidenav">
                <nav class="sidenav-menu-nested nav accordion" id="accordionSidenavPagesMenu">
                    <a class="nav-link {{ Route::currentRouteName() == 'admin.pages.index' ? 'active' : '' }}" href="{{ route('admin.pages.index') }}">
                        <div class="nav-link-icon">
                            <i class="fas fa-list-ul fa-lg fa-fw"></i>
                        </div>
                        Lista stron
                    </a>
                    <a class="nav-link {{ Route::currentRouteName() == 'admin.pages.create' ? 'active' : '' }}" href="{{ route('admin.pages.create') }}">
                        <div class="nav-link-icon">
                            <i class="fas fa-plus-square fa-lg fa-fw"></i>
                        </div>
                        Dodaj stronę
                    </a>
                </nav>
            </div>
            <div class="sidenav-menu-heading">Informacje</div>
            <a class="nav-link" href="dashboard-3.html">
                <div class="nav-link-icon">
                    <i class="fas fa-history fa-lg fa-fw"></i>
                </div>
                Historia zakupów
            </a>
            <a class="nav-link" href="dashboard-3.html">
                <div class="nav-link-icon {{ Route::currentRouteName() == 'admin.logs.acp' ? 'active' : '' }}">
                    <i class="fas fa-database fa-lg fa-fw"></i>
                </div>
                Logi
            </a>
            <div class="sidenav-menu-heading">Konfiguracja</div>
            <a class="nav-link" href="dashboard-3.html">
                <div class="nav-link-icon">
                    <i class="fas fa-puzzle-piece fa-lg fa-fw"></i>
                </div>
                Widgety
            </a>
            <a
                class="nav-link {{ (!Str::startsWith(Route::currentRouteName(), 'admin.settings.')) ? 'collapsed' : '' }}"
                href="javascript:void(0);" data-toggle="collapse" data-target="#collapseSettings"
                aria-expanded="{{ Str::startsWith(Route::currentRouteName('admin.settings.'), '') ? 'true' : 'false' }}" aria-controls="collapseSettings"
            >
                <div class="nav-link-icon">
                    <i class="fas fa-cogs fa-lg fa-fw"></i>
                </div>
                Ustawienia strony
                <div class="sidenav-collapse-arrow">
                    <i class="fas fa-angle-down"></i>
                </div>
            </a>
            <div class="collapse {{ Str::startsWith(Route::currentRouteName(), 'admin.settings.') ? 'show' : '' }}" id="collapseSettings" data-parent="#accordionSidenav">
                <nav class="sidenav-menu-nested nav accordion" id="accordionSidenavSettingsMenu">
                    <a class="nav-link" href="dashboard-3.html">
                        <div class="nav-link-icon">
                            <i class="fas fa-tools fa-lg fa-fw"></i>
                        </div>
                        Ogólne
                    </a>
                    <a class="nav-link" href="dashboard-3.html">
                        <div class="nav-link-icon">
                            <i class="fas fa-money-bill-wave fa-lg fa-fw"></i>
                        </div>
                        Płatności
                    </a>
                    <a class="nav-link" href="dashboard-3.html">
                        <div class="nav-link-icon">
                            <i class="fas fa-object-group fa-lg fa-fw"></i>
                        </div>
                        Wygląd
                    </a>
                    <a class="nav-link" href="dashboard-3.html">
                        <div class="nav-link-icon">
                            <i class="fas fa-mobile-alt fa-lg fa-fw"></i>
                        </div>
                        Numery SMS
                    </a>
                    <a class="nav-link" href="dashboard-3.html">
                        <div class="nav-link-icon">
                            <i class="fas fa-ticket-alt fa-lg fa-fw"></i>
                        </div>
                        Vouchery
                    </a>
                </nav>
            </div>
        </div>
    </div>
</nav>
