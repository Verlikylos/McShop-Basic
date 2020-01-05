@extends('admin.components.layout', ['withoutSidebar' => true])

@section('content')
    <div id="loginBox" class="row">
        <div class="col-12 col-md-6 col-lg-4 mx-auto">
            <h4>Logowanie do ACP</h4>
            
            @error('main')
                <div class="alert alert-danger my-3" role="alert">
                    {{ $message }}
                </div>
            @enderror
    
            <form method="POST" action="{{ route('auth.login') }}">
                @csrf
                
                <div class="form-group">
                    <label for="authUsername">Login</label>
                    <input type="text" class="form-control @error('authUsername') is-invalid @enderror" id="authUsername" name="authUsername" value="{{ old('authUsername') }}" required>
                    @error('authUsername')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="authPassword">Hasło</label>
                    <input type="password" class="form-control @error('authPassword') is-invalid @enderror" id="authPassword" name="authPassword" required>
                    @error('authPassword')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="authRemember" name="authRemember">
                        <label class="custom-control-label" for="authRemember">Zapamiętaj mnie</label>
                    </div>
                </div>
        
                <button class="btn btn-success"><i class="fas fa-sign-in-alt"></i> Zaloguj</button>
            </form>
        </div>
    </div>
@endsection
