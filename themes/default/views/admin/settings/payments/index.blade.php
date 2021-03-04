@extends('admin.components.layout')

@section('title', 'Ustawienia płatności')

@section('acp-card-title')
    <h4 class="acp-card-title">
        <i class="fas fa-credit-card"></i> Ustawienia płatności
    </h4>
@endsection

@section('content')
    @include('admin.settings.payments.components.menu')
    
    <form action="{{ route('admin.settings.payments.update') }}" method="POST">
        @csrf
        @method('PATCH')
        
        <div class="container">
            <div class="row">
                <div class="col-12 col-md-8 col-lg-4 mx-auto">
                    <div class="form-group">
                        <label for="paymentSmsOperator">Operator płatności SMS</label>
                        <select class="selectpicker @error('paymentSmsOperator') is-invalid @enderror" id="paymentSmsOperator" name="paymentSmsOperator">
                            <option value="">Wybierz operatora...</option>
            
                            @foreach (config('mcshop.payment_providers.sms') as $key => $provider)
                                <option value="{{ $key }}" {{ setting('settings_payments_sms_operator') == $key ? 'selected' : '' }}>{{ $provider['name'] }}</option>
                            @endforeach
                        </select>
                        @error('paymentSmsOperator')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>
    
                    <div class="form-group">
                        <label for="paymentPscOperator">Operator płatności PSC</label>
                        <select class="selectpicker @error('paymentPscOperator') is-invalid @enderror" id="paymentPscOperator" name="paymentPscOperator">
                            <option value="">Wybierz operatora...</option>
    
                            @foreach (config('mcshop.payment_providers.psc') as $key => $provider)
                                <option value="{{ $key }}" {{ setting('settings_payments_psc_operator') == $key ? 'selected' : '' }}>{{ $provider['name'] }}</option>
                            @endforeach
                        </select>
                        @error('paymentPscOperator')
                        <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>
    
                    <div class="form-group">
                        <label for="paymentTransferOperator">Operator płatności przelewem</label>
                        <select class="selectpicker @error('paymentTransferOperator') is-invalid @enderror" id="paymentTransferOperator" name="paymentTransferOperator">
                            <option value="">Wybierz operatora...</option>
                        </select>
                        @error('paymentTransferOperator')
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
