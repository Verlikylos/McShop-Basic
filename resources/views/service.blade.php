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
                    <h5 class="mt-3">Koszt usługi:</h5>
                    <ul class="list-group service-pricing-table shadow-sm">
                        @if ($service->getSmsNumber() != null && $service->getSmsNumber()->exists)
                            <li class="list-group-item">
                                <span>
                                    <i class="fas fa-mobile-alt fa-fw"></i> SMS Premium:
                                </span>
                                <span class="badge badge-primary">{{ $service->getSmsNumber()->getBruttoCostFormatted() }}</span>
                            </li>
                        @endif
                        @if ($service->getPscCost() > 0)
                            <li class="list-group-item">
                                <span>
                                    <i class="fas fa-lock fa-fw"></i> PaySafeCard:
                                </span>
                                <span class="badge badge-primary">{{ $service->getPscCostFormatted() }}</span>
                            </li>
                        @endif
                        @if ($service->getTransferCost() > 0)
                            <li class="list-group-item">
                                <span>
                                    <i class="fas fa-credit-card fa-fw"></i> Przelew:
                                </span>
                                <span class="badge badge-primary">{{ $service->getTransferCostFormatted() }}</span>
                            </li>
                        @endif
                        @if ($service->getPaypalCost() > 0)
                            <li class="list-group-item">
                                <span>
                                    <i class="fab fa-paypal fa-fw"></i> PayPal:
                                </span>
                                <span class="badge badge-primary">{{ $service->getPaypalCostFormatted() }}</span>
                            </li>
                        @endif
                    </ul>
                    <h5 class="mt-3">Ostatnio tą usługę zakupili:</h5>
                    <div class="service-last-customers">
                        @for ($i = 0; $i < 8; $i++)
                            <img class="avatar shadow-sm" src="https://crafatar.com/avatars/61296cbd20144ebebfd38695b2a864b3" alt="player head" data-toggle="tooltip" data-placement="top" title="Verlikylos">
                        @endfor
                    </div>
                </div>
                <div class="col-12 col-md-8">
                    <h3>{{ $service->getName() }}</h3>
                    <div>
                        {!! $service->getFormattedDescription() !!}
                    </div>
                </div>
            </div>
    
            <div id="servicePaymentTabs" class="shadow-sm">
                <ul class="nav nav-pills nav-fill" id="pills-tab" role="tablist">
                    @if ($service->getSmsNumber() != null && $service->getSmsNumber()->exists)
                        <li class="nav-item">
                            <a class="nav-link active" id="pills-sms-tab" data-toggle="pill" href="#sms-tab" role="tab" aria-controls="sms-tab" aria-selected="true">
                                <i class="fas fa-mobile-alt"></i> SMS Premium
                            </a>
                        </li>
                    @endif
                    @if ($service->getPscCost() > 0)
                        <li class="nav-item">
                            <a class="nav-link" id="pills-psc-tab" data-toggle="pill" href="#psc-tab" role="tab" aria-controls="psc-tab" aria-selected="false">
                                <i class="fas fa-lock"></i> PaySafeCard
                            </a>
                        </li>
                    @endif
                    @if ($service->getTransferCost() > 0)
                        <li class="nav-item">
                            <a class="nav-link" id="pills-transfer-tab" data-toggle="pill" href="#transfer-tab" role="tab" aria-controls="transfer-tab" aria-selected="false">
                                <i class="fas fa-credit-card"></i> Przelew
                            </a>
                        </li>
                    @endif
                    @if ($service->getPaypalCost() > 0)
                        <li class="nav-item">
                            <a class="nav-link" id="pills-paypal-tab" data-toggle="pill" href="#paypal-tab" role="tab" aria-controls="paypal-tab" aria-selected="false">
                                <i class="fab fa-paypal"></i> PayPal
                            </a>
                        </li>
                    @endif
                </ul>
                <div class="tab-content" id="pills-tabContent">
                    @if ($service->getSmsNumber() != null && $service->getSmsNumber()->exists)
                        <div class="tab-pane fade show active" id="sms-tab" role="tabpanel" aria-labelledby="pills-sms-tab">
                            <div class="row">
                                <div class="col-12 col-md-6 col-lg-4 mx-auto">
                                    <h4>
                                        <i class="fas fa-mobile-alt"></i> Płatność SMS Premium
                                    </h4>
                                    <span class="badge badge-primary">
                                        Koszt: {{ $service->getSmsNumber()->getNettoCostFormatted() }} ({{ $service->getSmsNumber()->getBruttoCostFormatted() }} z VAT)
                                    </span>
                                    
                                    <p class="service-payment-cta">
                                        Aby aktywować usługę, wyślij SMS o treści<br />
                                        <span class="font-weight-bold">AP.HOSTMC</span> pod numer <span class="font-weight-bold">{{ $service->getSmsNumber()->getNumber() }}</span>.<br />
                                        Otrzymany kod wprowadź poniżej:
                                    </p>
        
                                    <form>
                                        <div class="form-group">
                                            <label for="username">Twój nick z serwera</label>
                                            <input type="text" class="form-control" id="username" name="username" placeholder="Twój nick z serwera">
                                        </div>
                                        <div class="form-group">
                                            <label for="code">Kod z SMS</label>
                                            <input type="text" class="form-control" id="code" name="code" placeholder="Kod z SMS">
                                        </div>
                                        
                                        <button class="btn btn-success">Zrealizuj usługę</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endif
                    @if ($service->getPscCost() > 0)
                        <div class="tab-pane fade" id="psc-tab" role="tabpanel" aria-labelledby="pills-psc-tab">
                            <div class="row">
                                <div class="col-12 col-md-6 col-lg-4 mx-auto">
                                    <h4>
                                        <i class="fas fa-lock"></i> Płatność PaySafeCard
                                    </h4>
                                    <span class="badge badge-primary">
                                        Koszt: {{ $service->getPscCostFormatted() }}
                                    </span>
        
                                    <p class="service-payment-cta">
                                        Aby aktywować usługę,<br />
                                        wpisz poniżej swój nick z serwera i przejdź dalej.
                                    </p>
        
                                    <form>
                                        <div class="form-group">
                                            <label for="username">Twój nick z serwera</label>
                                            <input type="text" class="form-control" id="username" name="username" placeholder="Twój nick z serwera">
                                        </div>
            
                                        <button class="btn btn-success">Zrealizuj usługę</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endif
                    @if ($service->getTransferCost() > 0)
                        <div class="tab-pane fade" id="transfer-tab" role="tabpanel" aria-labelledby="pills-transfer-tab">
                            <div class="row">
                                <div class="col-12 col-md-6 col-lg-4 mx-auto">
                                    <h4>
                                        <i class="fas fa-credit-card"></i> Płatność przelewem
                                    </h4>
                                    <span class="badge badge-primary">
                                        Koszt: {{ $service->getTransferCostFormatted() }}
                                    </span>
        
                                    <p class="service-payment-cta">
                                        Aby aktywować usługę,<br />
                                        wpisz poniżej swój nick z serwera i przejdź dalej.
                                    </p>
        
                                    <form>
                                        <div class="form-group">
                                            <label for="username">Twój nick z serwera</label>
                                            <input type="text" class="form-control" id="username" name="username" placeholder="Twój nick z serwera">
                                        </div>
            
                                        <button class="btn btn-success">Zrealizuj usługę</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endif
                    @if ($service->getPaypalCost() > 0)
                        <div class="tab-pane fade" id="paypal-tab" role="tabpanel" aria-labelledby="pills-paypal-tab">
                            <div class="row">
                                <div class="col-12 col-md-6 col-lg-4 mx-auto">
                                    <h4>
                                        <i class="fab fa-paypal"></i> Płatność PayPal
                                    </h4>
                                    <span class="badge badge-primary">
                                        Koszt: {{ $service->getPaypalCostFormatted() }}
                                    </span>
        
                                    <p class="service-payment-cta">
                                        Aby aktywować usługę,<br />
                                        wpisz poniżej swój nick z serwera i przejdź dalej.
                                    </p>
        
                                    <form>
                                        <div class="form-group">
                                            <label for="username">Twój nick z serwera</label>
                                            <input type="text" class="form-control" id="username" name="username" placeholder="Twój nick z serwera">
                                        </div>
            
                                        <button class="btn btn-success">Zrealizuj usługę</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
