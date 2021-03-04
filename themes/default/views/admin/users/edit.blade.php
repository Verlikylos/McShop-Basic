@extends('admin.components.layout')

@section('title', 'Edycja użytkownika ' . $user->getName())

@section('acp-card-title')
    <h1>
        <i class="fas fa-edit"></i> Edycja użytkownika
        <span class="font-weight-bold">
            {{ $user->getName() . ' (ID: #' . $user->getAuthIdentifier() . ')' }}
        </span>
    </h1>
@endsection

@section('content')
    <form method="POST" action="{{ route('admin.users.update', $user->getAuthIdentifier()) }}">
        @csrf
        @method('PATCH')

        <div class="row">
            <div class="col-12 col-md-6">
                <div class="mb-3">
                    <label class="form-label" for="userName">Nazwa użytkownika</label>
                    <input type="text" class="form-control" id="userName" name="userName" value="{{ $user->getName() }}" required disabled>
                </div>
            </div>
            <div class="col-12 col-md-6">
                <span class="form-label">Uprawnienia</span>
                <ul class="list-group permissions-list mt-2 mb-3">
                    <li class="list-group-item">
                        <span class="permission-desc">
                            Dostęp do zakładki "Użytkownicy ACP"
                        </span>
                        <div class="checkbox-wrapper">
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" id="permissionUsers" name="permissionUsers" {{ $user->getPermissions()->users ? 'checked' : '' }}>
                                <label class="form-check-label" for="permissionUsers"></label>
                            </div>
                        </div>
                    </li>
                    <li class="list-group-item">
                        <span class="permission-desc">
                            Dostęp do zakładki "Serwery"
                        </span>
                        <div class="checkbox-wrapper">
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" id="permissionServers" name="permissionServers" {{ $user->getPermissions()->servers ? 'checked' : '' }}>
                                <label class="form-check-label" for="permissionServers"></label>
                            </div>
                        </div>
                    </li>
                    <li class="list-group-item">
                        <span class="permission-desc">
                            Dostęp do zakładki "Usługi"
                        </span>
                        <div class="checkbox-wrapper">
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" id="permissionServices" name="permissionServices" {{ $user->getPermissions()->services ? 'checked' : '' }}>
                                <label class="form-check-label" for="permissionServices"></label>
                            </div>
                        </div>
                    </li>
                    <li class="list-group-item">
                        <span class="permission-desc">
                            Dostęp do zakładki "Vouchery"
                        </span>
                        <div class="checkbox-wrapper">
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" id="permissionVouchers" name="permissionVouchers" {{ $user->getPermissions()->vouchers ? 'checked' : '' }}>
                                <label class="form-check-label" for="permissionVouchers"></label>
                            </div>
                        </div>
                    </li>
                    <li class="list-group-item">
                        <span class="permission-desc">
                            Dostęp do zakładki "Własne strony"
                        </span>
                        <div class="checkbox-wrapper">
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" id="permissionPages" name="permissionPages" {{ $user->getPermissions()->pages ? 'checked' : '' }}>
                                <label class="form-check-label" for="permissionPages"></label>
                            </div>
                        </div>
                    </li>
                    <li class="list-group-item">
                        <span class="permission-desc">
                            Dostęp do zakładki "Historia zakupów"
                        </span>
                        <div class="checkbox-wrapper">
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" id="permissionPurchases" name="permissionPurchases" {{ $user->getPermissions()->purchases ? 'checked' : '' }}>
                                <label class="form-check-label" for="permissionPurchases"></label>
                            </div>
                        </div>
                    </li>
                    <li class="list-group-item">
                        <span class="permission-desc">
                            Dostęp do zakładki "Logi"
                        </span>
                        <div class="checkbox-wrapper">
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" id="permissionLogs" name="permissionLogs" {{ $user->getPermissions()->logs ? 'checked' : '' }}>
                                <label class="form-check-label" for="permissionLogs"></label>
                            </div>
                        </div>
                    </li>
                    <li class="list-group-item">
                        <span class="permission-desc">
                            Dostęp do zakładki "Ustawienia strony"
                        </span>
                        <div class="checkbox-wrapper">
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" id="permissionSettings" name="permissionSettings" {{ $user->getPermissions()->settings ? 'checked' : '' }}>
                                <label class="form-check-label" for="permissionSettings"></label>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
        <div class="row">
            <div class="col-12 text-center">
                <button type="submit" class="btn btn-success mt-5 mb-3">
                    <i class="fas fa-check"></i> Zapisz zmiany
                </button>
            </div>
        </div>
    </form>
@endsection
