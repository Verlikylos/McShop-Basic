@extends('admin.components.layout')

@section('title', 'Ustawienia płatności Lvlup.pro')

@section('acp-card-title')
    <h4 class="acp-card-title">
        <i class="fas fa-credit-card"></i> Ustawienia płatności MicroSMS.pl
    </h4>
@endsection

@section('content')
    @include('admin.settings.payments.components.menu')
    
    <form action="{{ route('admin.settings.payments.lvlup.update') }}" method="POST">
        @csrf
        @method('PATCH')
        
        <div class="container">
            <div class="row">
                <div class="col-12 col-md-8 col-lg-4 mx-auto">
                    <div class="form-group">
                        <div class="form-group">
                            <label for="lvlupApiKey">Klucz API</label>
                            <input type="text" class="form-control @error('lvlupApiKey') is-invalid @enderror" id="lvlupApiKey" name="lvlupApiKey" value="{{ setting('settings_payments_lvlup_apiKey') }}">
                            @error('lvlupApiKey')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                    
                    <div class="text-center">
                        <button type="submit" class="btn btn-success my-5"><i class="fas fa-check"></i> Zapisz zmiany</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection
