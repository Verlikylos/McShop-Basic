@extends('admin.components.layout')

@section('title', 'Ustawienia voucherów')

@section('acp-card-title')
    <h4 class="acp-card-title">
        <i class="fas fa-ticket-alt"></i> Ustawienia voucherów
    </h4>
    <a href="{{ route('admin.settings.index') }}" class="btn btn-outline-primary">
        <i class="fas fa-chevron-left"></i>
        Wróć
    </a>
@endsection

@section('content')
    <div class="row">
        <div class="col-12 col-md-8 col-lg-4 mx-auto">
            <form method="POST" action="{{ route('admin.settings.voucher.update') }}">
                @csrf
                @method('PATCH')
                
                <div class="form-group">
                    <label for="voucherDefaultPrefix">Domyślny prefix vouchera</label>
                    <input type="text" class="form-control @error('voucherDefaultPrefix') is-invalid @enderror" id="voucherDefaultPrefix" name="voucherDefaultPrefix" value="{{ setting('voucher_default_prefix') }}">
                    @error('voucherDefaultPrefix')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
                
                <div class="form-group">
                    <label for="voucherDefaultCodeLength">Domyślna długość kodu vouchera</label>
                    <input type="number" class="form-control @error('voucherDefaultCodeLength') is-invalid @enderror" id="voucherDefaultCodeLength" name="voucherDefaultCodeLength" value="{{ setting('voucher_default_code_length') }}">
                    @error('voucherDefaultCodeLength')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
                
                <div class="text-center">
                    <button type="submit" class="btn btn-success my-5"><i class="fas fa-check"></i> Zapisz zmiany</button>
                </div>
            </form>
        </div>
    </div>
@endsection
