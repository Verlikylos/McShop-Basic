@extends('admin.components.layout')

@section('title', 'Ustawienia płatności HotPay.pl')

@section('acp-card-title')
    <h4 class="acp-card-title">
        <i class="fas fa-credit-card"></i> Ustawienia płatności HotPay.pl
    </h4>
@endsection

@section('content')
    @include('admin.settings.payments.components.menu')
    
    <form action="{{ route('admin.settings.payments.hotpay.update') }}" method="POST">
        @csrf
        @method('PATCH')
        
        <div class="container">
            <div class="row">
                <div class="col-12 col-md-8 col-lg-4 mx-auto">
                    
                    
                    <div class="text-center">
                        <button type="submit" class="btn btn-success my-5"><i class="fas fa-check"></i> Zapisz zmiany</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection
