@extends('admin.components.layout')

@section('title', 'Ustawienia strony')

@section('acp-card-title')
    <h4 class="acp-card-title">
        <i class="fas fa-cogs"></i> Ustawienia strony
    </h4>
@endsection

@section('content')
<div class="row">
    <div class="col-12 col-md-6 col-lg-4 mb-3">
        <div class="card settings-card">
            <div class="card-body">
                <h5 class="card-title font-weight-bold">
                    <i class="fas fa-tools"></i>
                    Ogólne
                </h5>
                <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
                <a href="{{ route('admin.settings.general.index') }}" class="btn btn-primary">
                    Przejdź
                    <i class="fas fa-chevron-right ml-1"></i>
                </a>
            </div>
        </div>
    </div>
    <div class="col-12 col-md-6 col-lg-4 mb-3">
        <div class="card settings-card">
            <div class="card-body">
                <h5 class="card-title font-weight-bold">
                    <i class="fas fa-money-bill-wave"></i>
                    Płatności
                </h5>
                <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
                <a href="#" class="btn btn-primary">
                    Przejdź
                    <i class="fas fa-chevron-right ml-1"></i>
                </a>
            </div>
        </div>
    </div>
    <div class="col-12 col-md-6 col-lg-4 mb-3">
        <div class="card settings-card">
            <div class="card-body">
                <h5 class="card-title font-weight-bold">
                    <i class="fas fa-sms"></i>
                    Numery SMS
                </h5>
                <p class="card-text">Możesz skonfigurować tu numery SMS Premium dla wybranych operatorów płatności.</p>
                <a href="{{ route('admin.settings.numbers.index') }}" class="btn btn-primary">
                    Przejdź
                    <i class="fas fa-chevron-right ml-1"></i>
                </a>
            </div>
        </div>
    </div>
    <div class="col-12 col-md-6 col-lg-4 mb-3">
        <div class="card settings-card">
            <div class="card-body">
                <h5 class="card-title font-weight-bold">
                    <i class="fas fa-ticket-alt"></i>
                    Vouchery
                </h5>
                <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
                <a href="#" class="btn btn-primary">
                    Przejdź
                    <i class="fas fa-chevron-right ml-1"></i>
                </a>
            </div>
        </div>
    </div>
    <div class="col-12 col-md-6 col-lg-4 mb-3">
        <div class="card settings-card">
            <div class="card-body">
                <h5 class="card-title font-weight-bold">
                    <i class="fas fa-object-group"></i>
                    Wygląd
                </h5>
                <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
                <a href="{{ route('admin.settings.layout.index') }}" class="btn btn-primary">
                    Przejdź
                    <i class="fas fa-chevron-right ml-1"></i>
                </a>
            </div>
        </div>
    </div>
    <div class="col-12 col-md-6 col-lg-4 mb-3">
        <div class="card settings-card">
            <div class="card-body">
                <h5 class="card-title font-weight-bold">
                    <i class="fas fa-sliders-h"></i>
                    Inne
                </h5>
                <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
                <a href="#" class="btn btn-primary">
                    Przejdź
                    <i class="fas fa-chevron-right ml-1"></i>
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
