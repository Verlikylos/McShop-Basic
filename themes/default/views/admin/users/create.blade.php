@extends('admin.components.layout')

@section('title', 'Tworzenie nowego użytkownika ACP')

@section('acp-card-title')
    <h1>
        <i class="fas fa-users"></i> Tworzenie nowego użytkownika ACP
    </h1>
@endsection

@section('content')
    <form method="POST" action="{{ route('admin.users.store') }}">
        @csrf
        @method('POST')

        <div class="row">
            <div class="col-12 col-md-6">
                <div class="form-group mb-3">
                    <input type="text" class="form-control @error('userName') is-invalid @enderror" id="userName" name="userName" value="{{ old('userName') }}" required>
                    <label class="form-label" for="userName">Nazwa użytkownika</label>
                    @error('userName')
                    <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <div class="col-12 col-md-6">
                <span class="form-label">Uprawnienia</span>
                <ul class="list-group list-group-thick permissions-list mt-2 mb-3">
                    <li class="list-group-item">
                        <span class="permission-desc">
                            Dostęp do zakładki "Użytkownicy ACP"
                        </span>
                        <div class="checkbox-wrapper">
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" id="permissionUsers" name="permissionUsers" {{ old('permissionUsers') ? 'checked' : '' }}>
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
                                <input type="checkbox" class="form-check-input" id="permissionServers" name="permissionServers" {{ old('permissionServers') ? 'checked' : '' }}>
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
                                <input type="checkbox" class="form-check-input" id="permissionServices" name="permissionServices" {{ old('permissionServices') ? 'checked' : '' }}>
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
                                <input type="checkbox" class="form-check-input" id="permissionVouchers" name="permissionVouchers" {{ old('permissionVouchers') ? 'checked' : '' }}>
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
                                <input type="checkbox" class="form-check-input" id="permissionPages" name="permissionPages" {{ old('permissionPages') ? 'checked' : '' }}>
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
                                <input type="checkbox" class="form-check-input" id="permissionPurchases" name="permissionPurchases" {{ old('permissionPurchases') ? 'checked' : '' }}>
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
                                <input type="checkbox" class="form-check-input" id="permissionLogs" name="permissionLogs" {{ old('permissionLogs') ? 'checked' : '' }}>
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
                                <input type="checkbox" class="form-check-input" id="permissionSettings" name="permissionSettings" {{ old('permissionSettings') ? 'checked' : '' }}>
                                <label class="form-check-label" for="permissionSettings"></label>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
        <div class="row">
            <div class="col-12 text-center">
                <button type="submit" class="btn btn-success mt-5 mb-3"><i class="fas fa-plus-square"></i> Dodaj użytkownika</button>
            </div>
        </div>
    </form>
@endsection
