@extends('admin.components.layout')

@section('title', 'Ustawienia płatności MicroSMS.pl')

@section('acp-card-title')
    <h4 class="acp-card-title">
        <i class="fas fa-credit-card"></i> Ustawienia płatności MicroSMS.pl
    </h4>
@endsection

@section('content')
    @include('admin.settings.payments.components.menu')
    
    <form action="{{ route('admin.settings.payments.microsms.update') }}" method="POST">
        @csrf
        @method('PATCH')
        
        <div class="container">
            <div class="row">
                <div class="col-12 col-md-8 col-lg-4 mx-auto">
                    <div class="form-group">
                        <label for="microsmsUserId">Id użytkownika</label>
                        <input type="text" class="form-control @error('microsmsUserId') is-invalid @enderror" id="microsmsUserId" name="microsmsUserId" value="{{ setting('settings_payments_microsms_userid') }}">
                        @error('microsmsUserId')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>
                    
                    <div class="form-group">
                        <label for="microsmsSmsChannel">Kanał SMS</label>
                        <input type="text" class="form-control @error('microsmsSmsChannel') is-invalid @enderror" id="microsmsSmsChannel" name="microsmsSmsChannel" value="{{ setting('settings_payments_microsms_sms_channel') }}">
                        @error('microsmsSmsChannel')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>
                    
                    <div class="form-group">
                        <label for="microsmsSmsChannelId">ID kanału SMS</label>
                        <input type="text" class="form-control @error('microsmsSmsChannelId') is-invalid @enderror" id="microsmsSmsChannelId" name="microsmsSmsChannelId" value="{{ setting('settings_payments_microsms_sms_serviceid') }}">
                        @error('microsmsSmsChannelId')
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
