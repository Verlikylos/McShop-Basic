@extends('components.layout')

@section('title', 'Status zamówienia #' . $order->getId())

@section('breadcrumb')
    <li class="breadcrumb-item active" aria-current="page">Status zamówienia #{{ $order->getId() }}</li>
@endsection

@section('content')
    <div class="card shadow payment-redirect-card">
        <div class="card-body d-flex align-items-center justify-content-center flex-column">
            @if ($order->getStatus() == 'CREATED')
                <i class="fas fa-hourglass-half fa-spin fa-5x"></i>
                <h4 class="mt-5">Trwa oczekiwanie na potwierdzenie płatności...</h4>
                <button class="btn btn-primary mt-5" onclick="location.reload()"><i class="fas fa-sync"></i> Odśwież stronę</button>
            @elseif ($order->getStatus() == 'PAID')
                <i class="fas fa-hourglass-half fa-spin fa-5x"></i>
                <h4 class="mt-5">Płatność została potwierdzona! Trwa realizacja zamówienia...</h4>
                <button class="btn btn-primary mt-5" onclick="location.reload()"><i class="fas fa-sync"></i> Odśwież stronę</button>
            @elseif ($order->getStatus() == 'COMPLETED')
                <i class="fas fa-check fa-5x"></i>
                <h4 class="mt-5">Usługa <span class="font-weight-bold">{{ $order->getService()->getName() }}</span> z serwera <span class="font-weight-bold">{{ $order->getService()->getServer()->getName() }}</span> została pomyślnie zrealizowana!</h4>
                <a class="btn btn-primary mt-5" href="{{ route('home') }}"><i class="fas fa-chevron-left"></i> Powrót do strony głównej</a>
            @elseif ($order->getStatus() == 'CANCELED')
                <i class="fas fa-exclamation-triangle fa-5x"></i>
                <h4 class="mt-5">Zamówienie zostało anulowane!</h4>
                <a class="btn btn-primary mt-5" href="{{ route('home') }}"><i class="fas fa-chevron-left"></i> Powrót do strony głównej</a>
            @else
                <i class="fas fa-exclamation-triangle fa-5x"></i>
                <h4 class="mt-5">Wystąpił błąd podczas realizacji Twojego zamówienia. Skontaktuj się z administracją serwera</h4>
                <a class="btn btn-primary mt-5" href="{{ route('home') }}"><i class="fas fa-chevron-left"></i> Powrót do strony głównej</a>
            @endif
        </div>
    </div>
@endsection
