<ul class="nav nav-pills nav-fill mb-5">
    <li class="nav-item">
        <a class="nav-link {{ Route::currentRouteName() === 'admin.settings.payments.index' ? 'active' : '' }}" href="{{ route('admin.settings.payments.index') }}">
            Ogólne
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link {{ Route::currentRouteName() === 'admin.settings.payments.lvlup.index' ? 'active' : '' }}" href="{{ route('admin.settings.payments.lvlup.index') }}">
            Lvlup.pro
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link {{ Route::currentRouteName() === 'admin.settings.payments.microsms.index' ? 'active' : '' }}" href="{{ route('admin.settings.payments.microsms.index') }}">
            MicroSMS.pl
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link {{ Route::currentRouteName() === 'admin.settings.payments.paybylink.index' ? 'active' : '' }}" href="{{ route('admin.settings.payments.paybylink.index') }}">
            PayByLink.pl
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link {{ Route::currentRouteName() === 'admin.settings.payments.hotpay.index' ? 'active' : '' }}" href="{{ route('admin.settings.payments.hotpay.index') }}">
            HotPay.pl
        </a>
    </li>
</ul>
