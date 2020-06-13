@extends('components.layout')

@section('title', 'Usługa ' . $service->getName() . ' z serwera ' . $server->getName())

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('home', $server->getSlug()) }}">{{ 'Sklep serwera ' . $server->getName() }}</a></li>
    <li class="breadcrumb-item active" aria-current="page">{{ 'Usługa ' . $service->getName() }}</li>
@endsection

@section('content')
    <div class="card shadow">
        <div class="card-body">
            <div class="row">
                <div class="col-12 col-md-4">
                    <img class="img-fluid rounded shadow-sm" src="{{ $service->getImageUrl() }}" alt="{{ $service->getName() . '\'s image' }}">
                    <h5 class="mt-3">Ostatnio tą usługę zakupili:</h5>
                    <ul class="list-group service-last-customers shadow-sm w-100">
                        @for ($i = 0; $i < 8; $i++)
                            <li class="list-group-item">
                                <div class="player-info">
                                    <img class="avatar" src="https://minotar.net/avatar/Verlikylos/30" alt="player head" data-toggle="tooltip" data-placement="top" title="Verlikylos">
                                    <span class="player-name">Verlikylos</span>
                                </div>
                                <span class="date">
                                20:34 24/04/2020
                            </span>
                            </li>
                        @endfor
                    </ul>
                    <h4 class="service-purchases-amount">Ta usługa została zakupiona już <span class="badge badge-primary">84</span> razy!</h4>
                </div>
                <div class="col-12 col-md-8">
                    <h3>{{ $service->getName() }}</h3>
                    <div>
                        {!! $service->getFormattedDescription() !!}
                    </div>
                    <div class="container mt-5">
                        <div class="row">
                            <div class="col-12 col-lg-6">
                                <h4 class="payment-box-header">
                                    <span class="step">1</span>
                                    Podaj swój nick
                                </h4>
                                <div class="form-group">
                                    <input type="text" class="form-control @error('playerName') is-invalid @enderror" id="playerName" placeholder="Nick gracza" autocomplete="off" required>
                                    @error('playerName')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-12 col-lg-6">
                                <h4 class="payment-box-header">
                                    <span class="step">2</span>
                                    Wybierz metodę płatności
                                </h4>
                                <nav>
                                    <div id="servicePaymentTabs" class="nav nav-pills flex-column shadow-sm" role="tablist">
                                        @if ($service->getSmsNumber() != null && $service->getSmsNumber()->exists)
                                            <a class="nav-item nav-link active" id="pills-sms-tab" data-toggle="pill" href="#sms-tab" role="tab" aria-controls="sms-tab" aria-selected="true">
                                                <span>
                                                    <i class="fas fa-mobile-alt fa-fw"></i>
                                                    SMS Premium
                                                </span>
                                                <span class="badge">{{ $service->getSmsNumber()->getBruttoCostFormatted() }}</span>
                                            </a>
                                        @endif
                                        @if ($service->getPscCost() > 0)
                                            <a class="nav-item nav-link" id="pills-psc-tab" data-toggle="pill" href="#psc-tab" role="tab" aria-controls="psc-tab" aria-selected="false">
                                                <span>
                                                    <i class="fas fa-lock fa-fw"></i>
                                                    PaySafeCard
                                                </span>
                                                <span class="badge badge-primary">{{ $service->getPscCostFormatted() }}</span>
                                            </a>
                                        @endif
                                        @if ($service->getTransferCost() > 0)
                                            <a class="nav-item nav-link" id="pills-transfer-tab" data-toggle="pill" href="#transfer-tab" role="tab" aria-controls="transfer-tab" aria-selected="false">
                                                <span>
                                                    <i class="fas fa-credit-card fa-fw"></i>
                                                    Przelew
                                                </span>
                                                <span class="badge badge-primary">{{ $service->getTransferCostFormatted() }}</span>
                                            </a>
                                        @endif
                                        @if ($service->getPaypalCost() > 0)
                                            <a class="nav-item nav-link" id="pills-paypal-tab" data-toggle="pill" href="#paypal-tab" role="tab" aria-controls="paypal-tab" aria-selected="false">
                                                <span>
                                                    <i class="fab fa-paypal fa-fw"></i>
                                                    PayPal
                                                </span>
                                                <span class="badge badge-primary">{{ $service->getPaypalCostFormatted() }}</span>
                                            </a>
                                        @endif
                                    </div>
                                </nav>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <h4 class="payment-box-header mt-5">
                                    <span class="step">3</span>
                                    Dokonaj płatności
                                </h4>
                                <div class="tab-content" id="pills-tabContent">
                                    @if ($service->getSmsNumber() != null && $service->getSmsNumber()->exists)
                                        <div class="tab-pane fade show active" id="sms-tab" role="tabpanel" aria-labelledby="pills-sms-tab">
                                            <div class="container">
                                                <div class="row">
                                                    <div class="col-12 col-lg-6">
                                                        <p class="service-payment-cta">
                                                            Aby aktywować usługę, wyślij SMS o treści
                                                            <span class="font-weight-bold">{{ setting('settings_payments_' . setting('settings_payments_sms_operator') . '_sms_channel') }}</span> pod numer <span class="font-weight-bold">{{ $service->getSmsNumber()->getNumber() }}</span>.
                                                            Otrzymany kod wprowadź w polu obok.
                                                        </p>
                                                    </div>
                                                    <div class="col-12 col-lg-6 mh-100 d-flex flex-column justify-content-center align-items-center">
                                                        <div class="form-group w-100">
                                                            <input type="text" class="form-control @error('smsCode') is-invalid @enderror" id="smsCode" placeholder="Kod z SMS" autocomplete="off" required>
                                                            @error('smsCode')
                                                                <span class="invalid-feedback">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-12 mt-3 text-center">
                                                        <form action="{{ route('service.checkout.sms', ['server' => $service->getServer()->getSlug(), 'service' => $service->getSlug()]) }}" method="POST">
                                                            @csrf
                                                            
                                                            <input type="hidden" class="player-name-input" name="playerName" autocomplete="off" required>
                                                            <input type="hidden" class="sms-code-input" name="smsCode" autocomplete="off" required>
                                                            
                                                            <button type="submit" class="btn btn-lg btn-success">
                                                                <i class="fas fa-check"></i>
                                                                Zrealizuj usługę
                                                            </button>
                                                        </form>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-12 text-center">
                                                        @include ('components.sms_provider_info', ['provider' => config('mcshop.payment_providers.sms.' . setting('settings_payments_sms_operator'))])
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                    @if ($service->getPscCost() > 0)
                                        <div class="tab-pane text-center fade" id="psc-tab" role="tabpanel" aria-labelledby="pills-psc-tab">
                                            <form action="{{ route('service.checkout.psc', ['server' => $server->getSlug(), 'service' => $service->getSlug()]) }}" method="POST">
                                                @csrf
                                                <input type="hidden" class="player-name-input" name="playerName" autocomplete="off" required>
                                                
                                                <button type="submit" class="btn btn-lg btn-success my-5">
                                                    <i class="fas fa-lock"></i>
                                                    Przejdź do płatności
                                                </button>
                                            </form>
                                            <img class="mt-3" src="https://centrumpvp.pl/assets/images/rushpay.jpg" alt="rushpay">
                                            <p>
                                                Płatności zapewnia firma RushPay. Korzystanie z serwisu jest jednoznaczne z akceptacją regulaminów.
                                                Jeżeli podczas wykonywania płatności wystąpił błąd, skorzystaj z formularza reklamacyjnego.
                                                Przewidywany czas realizacji usługi: natychmiast. Podane ceny zawierają podatek VAT (23%).
                                            </p>
                                        </div>
                                    @endif
                                    @if ($service->getTransferCost() > 0)
                                        <div class="tab-pane text-center fade" id="transfer-tab" role="tabpanel" aria-labelledby="pills-transfer-tab">
                                            <button type="button" class="btn btn-lg btn-success my-5">
                                                <i class="fas fa-credit-card"></i>
                                                Przejdź do płatności
                                            </button>
                                            <img class="mt-3" src="https://centrumpvp.pl/assets/images/rushpay.jpg" alt="rushpay">
                                            <p>
                                                Płatności zapewnia firma RushPay. Korzystanie z serwisu jest jednoznaczne z akceptacją regulaminów.
                                                Jeżeli podczas wykonywania płatności wystąpił błąd, skorzystaj z formularza reklamacyjnego.
                                                Przewidywany czas realizacji usługi: natychmiast. Podane ceny zawierają podatek VAT (23%).
                                            </p>
                                        </div>
                                    @endif
                                    @if ($service->getPaypalCost() > 0)
                                        <div class="tab-pane text-center fade" id="paypal-tab" role="tabpanel" aria-labelledby="pills-paypal-tab">
                                            <button type="button" class="btn btn-lg btn-success my-5">
                                                <i class="fab fa-paypal"></i>
                                                Przejdź do płatności
                                            </button>
                                            <img class="mt-3" src="https://centrumpvp.pl/assets/images/rushpay.jpg" alt="rushpay">
                                            <p>
                                                Płatności zapewnia firma RushPay. Korzystanie z serwisu jest jednoznaczne z akceptacją regulaminów.
                                                Jeżeli podczas wykonywania płatności wystąpił błąd, skorzystaj z formularza reklamacyjnego.
                                                Przewidywany czas realizacji usługi: natychmiast. Podane ceny zawierają podatek VAT (23%).
                                            </p>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
