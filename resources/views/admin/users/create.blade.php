@extends('admin.components.layout')

@section('title', 'Tworzenie nowego użytkownika ACP')

@section('acp-card-title')
    <h4 class="acp-card-title">
        <i class="fas fa-users"></i> Tworzenie nowego użytkownika ACP
    </h4>
    <a href="{{ route('admin.users.index') }}" class="btn btn-outline-secondary"><i class="fas fa-times"></i> Anuluj</a>
@endsection

@section('content')
    <form method="POST" action="{{ route('admin.users.store') }}">
        @csrf
        @method('POST')

        <div class="row">
            <div class="col-12 col-md-8 col-lg-4 mx-auto">
                <div class="form-group">
                    <label for="userName">Nazwa użytkownika</label>
                    <input type="text" class="form-control @error('userName') is-invalid @enderror" id="userName" name="userName" value="{{ old('userName') }}">
                    @error('userName')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12 col-md-8 col-lg-6 mx-auto">
                <h6>Uprawnienia</h6>
                <ul class="list-group permissions-list">
                    <li class="list-group-item">
                        <span class="permission-desc">
                            Dostęp do zakładki "Użytkownicy ACP"
                        </span>
                        <div class="checkbox-wrapper">
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" id="permissionUsers" name="permissionUsers" {{ old('permissionUsers') ? 'checked' : '' }}>
                                <label class="custom-control-label" for="permissionUsers"></label>
                            </div>
                        </div>
                    </li>
                    <li class="list-group-item">
                        <span class="permission-desc">
                            Dostęp do zakładki "Serwery"
                        </span>
                        <div class="checkbox-wrapper">
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" id="permissionServers" name="permissionServers" {{ old('permissionServers') ? 'checked' : '' }}>
                                <label class="custom-control-label" for="permissionServers"></label>
                            </div>
                        </div>
                    </li>
                    <li class="list-group-item">
                        <span class="permission-desc">
                            Dostęp do zakładki "Usługi"
                        </span>
                        <div class="checkbox-wrapper">
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" id="permissionServices" name="permissionServices" {{ old('permissionServices') ? 'checked' : '' }}>
                                <label class="custom-control-label" for="permissionServices"></label>
                            </div>
                        </div>
                    </li>
                    <li class="list-group-item">
                        <span class="permission-desc">
                            Dostęp do zakładki "Vouchery"
                        </span>
                        <div class="checkbox-wrapper">
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" id="permissionVouchers" name="permissionVouchers" {{ old('permissionVouchers') ? 'checked' : '' }}>
                                <label class="custom-control-label" for="permissionVouchers"></label>
                            </div>
                        </div>
                    </li>
                    <li class="list-group-item">
                        <span class="permission-desc">
                            Dostęp do zakładki "Własne strony"
                        </span>
                        <div class="checkbox-wrapper">
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" id="permissionPages" name="permissionPages" {{ old('permissionPages') ? 'checked' : '' }}>
                                <label class="custom-control-label" for="permissionPages"></label>
                            </div>
                        </div>
                    </li>
                    <li class="list-group-item">
                        <span class="permission-desc">
                            Dostęp do zakładki "Historia zakupów"
                        </span>
                        <div class="checkbox-wrapper">
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" id="permissionPurchases" name="permissionPurchases" {{ old('permissionPurchases') ? 'checked' : '' }}>
                                <label class="custom-control-label" for="permissionPurchases"></label>
                            </div>
                        </div>
                    </li>
                    <li class="list-group-item">
                        <span class="permission-desc">
                            Dostęp do zakładki "Logi"
                        </span>
                        <div class="checkbox-wrapper">
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" id="permissionLogs" name="permissionLogs" {{ old('permissionLogs') ? 'checked' : '' }}>
                                <label class="custom-control-label" for="permissionLogs"></label>
                            </div>
                        </div>
                    </li>
                    <li class="list-group-item">
                        <span class="permission-desc">
                            Dostęp do zakładki "Ustawienia strony"
                        </span>
                        <div class="checkbox-wrapper">
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" id="permissionSettings" name="permissionSettings" {{ old('permissionSettings') ? 'checked' : '' }}>
                                <label class="custom-control-label" for="permissionSettings"></label>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
        <div class="row">
            <div class="col-12 text-center">
                <button type="submit" class="btn btn-success my-5"><i class="fas fa-plus"></i> Dodaj użytkownika</button>
            </div>
        </div>
    </form>
@endsection
