@extends('admin.components.layout', ['withJasnyBootstrap' => true])

@section('title', 'Edycja usługi ' . $service->getName())

@section('acp-card-title')
    <h4 class="acp-card-title">
        <i class="fas fa-edit"></i> Edycja usługi <span class="font-weight-bold">{{ $service->getName() . ' (ID: #' . $service->getId() . ')' }}</span>
    </h4>
    <a href="{{ route('admin.services.index', $service->getServer()->getSlug()) }}" class="btn btn-outline-secondary"><i class="fas fa-times"></i> Anuluj</a>
@endsection

@section('content')
    <form id="createServiceForm" method="POST" action="{{ route('admin.services.update', $service->getSlug()) }}" enctype="multipart/form-data">
        @csrf
        @method('PATCH')
        
        <div class="row">
            <div class="col-12 col-md-8 col-lg-4 mx-auto">
                <div class="form-group">
                    <label for="serviceName">Nazwa usługi</label>
                    <input type="text" class="form-control @error('serviceName') is-invalid @enderror" id="serviceName" name="serviceName" value="{{ old('serviceName') ?? $service->getName() }}">
                    @error('serviceName')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group mt-3">
                    <label for="serviceServer">Serwer</label>
                    <select class="form-control @error('serviceServer') is-invalid @enderror" id="serviceServer" name="serviceServer">
                        <option value="">Wybierz serwer...</option>
                        @foreach ($servers as $server)
                            <option value="{{ $server->getId() }}" {{ old('serviceServer') == $server->getId() ? 'selected' : ($service->getServer()->getId() == $server->getId() ? 'selected' : '') }}>{{ 'Serwer ' . $server->getName() . ' (ID: #' . $server->getId() . ')' }}</option>
                        @endforeach
                    </select>
                    @error('serviceServer')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
                <h6 class="mt-1">Obrazek usługi</h6>
                <div class="fileinput fileinput-new w-100" data-provides="fileinput">
                    <div class="fileinput-new img-thumbnail server-preview-image">
                        <img src="{{ $service->getImageUrl() }}" alt="{{ $service->getName() . 'service\'s image'}}">
                    </div>
                    <div class="fileinput-preview fileinput-exists img-thumbnail service-preview-image"></div>
                    <div>
                        <span class="btn btn-outline-primary btn-block btn-file">
                          <span class="fileinput-new">Wybierz obrazek</span>
                          <span class="fileinput-exists">Zmień obrazek</span>
                          <input type="file" id="serviceImage" name="serviceImage" accept=".jpg,.jpeg,.png">
                        </span>
                        <a href="#" class="btn btn-outline-danger btn-block fileinput-exists mt-1" data-dismiss="fileinput">Usuń obrazek</a>
                    </div>
                    @error('serviceImage')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
            </div>
            
            <div class="col-12">
                <div id="serviceDescriptionEditor"></div>
                <input type="hidden" id="serviceDescription" name="serviceDescription" value="{{ old('serviceDescription') ?? $service->getDescription() }}">
            </div>
            
            <div class="col-12">
                <div class="custom-control custom-checkbox mt-4 mb-3 text-center">
                    <input type="checkbox" class="custom-control-input" id="serviceRequiresPlayer" name="serviceRequiresPlayer" {{ old('serviceRequiresPlayer') ? 'checked' : ($service->isRequiresOnlinePlayer() ? 'checked' : '') }}>
                    <label class="custom-control-label" for="serviceRequiresPlayer">Wymaga gracza online</label>
                </div>
            </div>
            
            <div class="col-12 col-md-8 col-lg-4 mx-auto">
                <div id="serviceCommandsWrapper">
                    <h6 class="mt-3">Komendy do wykonania</h6>
                    
                    <div id="commandInputs">
                        <div class="form-group">
                            <input type="text" class="form-control @error('serviceCommands') is-invalid @enderror serviceCommandInput" placeholder="Komenda #1">
                            @error('serviceCommands')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    
                    <input type="hidden" id="serviceCommands" name="serviceCommands" value="{{ old('serviceCommands') ?? json_encode($service->getCommands()) }}">
                    
                    <button type="button" id="addCommandInput" class="btn btn-outline-primary btn-block mb-2">Dodaj komendę</button>
                </div>
            </div>
            
            <div class="col-12"></div>
            
            <div class="col-12 col-md-8 col-lg-4 mx-auto">
                <div class="card border-primary mt-4">
                    <div class="card-header bg-primary text-white">
                        <div class="custom-control custom-switch text-center">
                            <input type="checkbox" class="custom-control-input" id="servicePaymentSmsNumber" data-collapse-target="smsCollapse" {{ old('serviceSmsNumber') ? 'checked' : ($service->getSmsNumber() != null ? 'checked' : '') }}>
                            <label class="custom-control-label" for="servicePaymentSmsNumber">Płatności SMS</label>
                        </div>
                    </div>
                    <div id="smsCollapse" class="card-body {{ $service->getSmsNumber() != null && $service->getSmsNumber()->exists ? '' : (old('serviceSmsNumber') ? '' : 'd-none') }}">
                        <div class="form-group">
                            <label for="serviceSmsNumber">Numer SMS</label>
                            <select class="form-control @error('serviceSmsNumber') is-invalid @enderror" id="serviceSmsNumber" name="serviceSmsNumber">
                                <option value="">Wybierz numer...</option>
                                @foreach ($numbers as $number)
                                    <option value="{{ $number->getId() }}" {{ old('serviceSmsNumber') == $number->getId() ? 'selected' : ($service->getSmsNumber() != null && $service->getSmsNumber()->getId() == $number->getId() ? 'selected' : '') }}>{{ $number->getNumber() . ' — ' . $number->getNettoCostFormatted() . ' (' .$number->getBruttoCostFormatted() . ' z VAT)' }}</option>
                                @endforeach
                            </select>
                            @error('serviceSmsNumber')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="card border-primary mt-3">
                    <div class="card-header bg-primary text-white">
                        <div class="custom-control custom-switch text-center">
                            <input type="checkbox" class="custom-control-input" id="servicePaymentPsc" data-collapse-target="pscCollapse" {{ old('servicePscCost') ? 'checked' : ($service->getPscCost() > 0 ? 'checked' : '') }}>
                            <label class="custom-control-label" for="servicePaymentPsc">Płatności PaySafeCard</label>
                        </div>
                    </div>
                    <div id="pscCollapse" class="card-body {{ $service->getPscCost() > 0 ? '' : (old('servicePscCost') ? '' : 'd-none') }}">
                        <div class="form-group">
                            <label for="servicePscCost">Koszt przy płatności PaySafeCard</label>
                            <input type="text" class="form-control @error('servicePscCost') is-invalid @enderror" id="servicePscCost" name="servicePscCost" value="{{ old('servicePscCost') ?? $service->getPscCost() }}">
                            @error('servicePscCost')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="card border-primary mt-3">
                    <div class="card-header bg-primary text-white">
                        <div class="custom-control custom-switch text-center">
                            <input type="checkbox" class="custom-control-input" id="servicePaymentTransfer" data-collapse-target="transferCollapse" {{ old('serviceTransferCost') ? 'checked' : ($service->getTransferCost() > 0 ? 'checked' : '') }}>
                            <label class="custom-control-label" for="servicePaymentTransfer">Płatności przelewem</label>
                        </div>
                    </div>
                    <div id="transferCollapse" class="card-body {{ $service->getTransferCost() > 0 ? '' : (old('serviceTransferCost') ? '' : 'd-none') }}">
                        <div class="form-group">
                            <label for="serviceTransferCost">Koszt przy płatności przelewem</label>
                            <input type="text" class="form-control @error('serviceTransferCost') is-invalid @enderror" id="serviceTransferCost" name="serviceTransferCost" value="{{ old('serviceTransferCost') ?? $service->getTransferCost() }}">
                            @error('serviceTransferCost')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="card border-primary mt-3">
                    <div class="card-header bg-primary text-white">
                        <div class="custom-control custom-switch text-center">
                            <input type="checkbox" class="custom-control-input" id="servicePaymentPaypal" data-collapse-target="paypalCollapse" {{ old('servicePaypalCost') ? 'checked' : ($service->getPaypalCost() > 0 ? 'checked' : '') }}>
                            <label class="custom-control-label" for="servicePaymentPaypal">Płatności PayPal</label>
                        </div>
                    </div>
                    <div id="paypalCollapse" class="card-body {{ $service->getPaypalCost() > 0 ? '' : (old('servicePaypalCost') ? '' : 'd-none') }}">
                        <div class="form-group">
                            <label for="servicePaypalCost">Koszt przy płatności PayPal</label>
                            <input type="text" class="form-control @error('servicePaypalCost') is-invalid @enderror" id="servicePaypalCost" name="servicePaypalCost" value="{{ old('servicePaypalCost') ?? $service->getPaypalCost() }}">
                            @error('servicePaypalCost')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 text-center">
                <button type="submit" class="btn btn-success my-5"><i class="fas fa-check"></i> Zapisz zmiany</button>
            </div>
        </div>
    </form>
@endsection
