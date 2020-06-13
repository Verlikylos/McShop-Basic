@extends('admin.components.layout', ['withJasnyBootstrap' => true])

@section('title', 'Tworzenie nowej usługi')

@section('acp-card-title')
    <h4 class="acp-card-title">
        <i class="fas fa-cubes"></i> Tworzenie nowej usługi
    </h4>
    <a href="{{ route('admin.services.index') }}" class="btn btn-outline-secondary"><i class="fas fa-times"></i> Anuluj</a>
@endsection

@section('content')
    <form id="createServiceForm" method="POST" action="{{ route('admin.services.store') }}" enctype="multipart/form-data">
        @csrf
        @method('POST')
        
        <div class="row">
            <div class="col-12 col-md-8 col-lg-4 mx-auto">
                <div class="form-group">
                    <label for="serviceName">Nazwa usługi</label>
                    <input type="text" class="form-control @error('serviceName') is-invalid @enderror" id="serviceName" name="serviceName" value="{{ old('serviceName') }}" required>
                    @error('serviceName')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group mt-3">
                    <label for="serviceServer">Serwer</label>
                    <select class="selectpicker @error('serviceServer') is-invalid @enderror" id="serviceServer" name="serviceServer" required>
                        <option value="">Wybierz serwer...</option>
                        @foreach ($servers as $server)
                            <option value="{{ $server->getId() }}" {{ old('serviceServer') == $server->getId() ? 'selected' : '' }}>{{ 'Serwer ' . $server->getName() . ' (ID: #' . $server->getId() . ')' }}</option>
                        @endforeach
                    </select>
                    @error('serviceServer')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
                <h6 class="mt-1">Obrazek usługi</h6>
                <div class="fileinput fileinput-new w-100" data-provides="fileinput">
                    <div class="fileinput-preview img-thumbnail service-preview-image" data-trigger="fileinput"></div>
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
                <span>Opis usługi</span>
                <div id="serviceDescriptionEditor"></div>
                <input type="hidden" id="serviceDescription" name="serviceDescription" value="{{ old('serviceDescription') }}">
            </div>
            
            <div class="col-12">
                <div class="custom-control custom-checkbox mt-4 mb-3 text-center">
                    <input type="checkbox" class="custom-control-input" id="serviceRequiresPlayer" name="serviceRequiresPlayer" {{ old('serviceRequiresPlayer') ? 'checked' : '' }}>
                    <label class="custom-control-label" for="serviceRequiresPlayer">Wymaga gracza online</label>
                </div>
            </div>
    
            <div class="col-12 col-md-8 col-lg-4 mx-auto">
                <div id="serviceCommandsWrapper">
                    <h6 class="mt-3">Komendy do wykonania</h6>
                    
                    <div id="commandInputs">
                        <div class="form-group">
                            <input type="text" class="form-control @error('serviceCommands') is-invalid @enderror serviceCommandInput" placeholder="Komenda #1" required>
                            @error('serviceCommands')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
    
                    <input type="hidden" id="serviceCommands" name="serviceCommands" value="{{ old('serviceCommands') }}">
                    
                    <button type="button" id="addCommandInput" class="btn btn-outline-primary btn-block mb-2">Dodaj komendę</button>
                </div>
            </div>
            
            <div class="col-12"></div>
    
            <div class="col-12 col-md-8 col-lg-4 mx-auto">
                <div class="card border-primary mt-4">
                    <div class="card-header bg-primary text-white">
                        <div class="custom-control custom-switch text-center">
                            <input type="checkbox" class="custom-control-input" id="servicePaymentSmsNumber" data-collapse-target="smsCollapse" {{ old('serviceSmsNumber') ? 'checked' : '' }}>
                            <label class="custom-control-label" for="servicePaymentSmsNumber">Płatności SMS</label>
                        </div>
                    </div>
                    <div id="smsCollapse" class="card-body {{ old('serviceSmsNumber') ? '' : 'd-none' }}">
                        <div class="form-group">
                            <label for="serviceSmsNumber">Numer SMS</label>
                            <select class="selectpicker @error('serviceSmsNumber') is-invalid @enderror" id="serviceSmsNumber" name="serviceSmsNumber">
                                <option value="">Wybierz numer...</option>
                                @foreach ($numbers as $number)
                                    <option value="{{ $number->getId() }}" {{ old('serviceSmsNumber') == $number->getId() ? 'selected' : '' }}>{{ $number->getNumber() . ' — ' . $number->getNettoCostFormatted() . ' (' .$number->getBruttoCostFormatted() . ' z VAT)' }}</option>
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
                            <input type="checkbox" class="custom-control-input" id="servicePaymentPsc" data-collapse-target="pscCollapse" {{ old('servicePscCost') ? 'checked' : '' }}>
                            <label class="custom-control-label" for="servicePaymentPsc">Płatności PaySafeCard</label>
                        </div>
                    </div>
                    <div id="pscCollapse" class="card-body {{ old('servicePscCost') ? '' : 'd-none' }}">
                        <div class="form-group">
                            <label for="servicePscCost">Koszt przy płatności PaySafeCard</label>
                            <input type="text" class="form-control @error('servicePscCost') is-invalid @enderror" id="servicePscCost" name="servicePscCost" value="{{ old('servicePscCost') }}">
                            @error('servicePscCost')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="card border-primary mt-3">
                    <div class="card-header bg-primary text-white">
                        <div class="custom-control custom-switch text-center">
                            <input type="checkbox" class="custom-control-input" id="servicePaymentTransfer" data-collapse-target="transferCollapse" {{ old('serviceTransferCost') ? 'checked' : '' }}>
                            <label class="custom-control-label" for="servicePaymentTransfer">Płatności przelewem</label>
                        </div>
                    </div>
                    <div id="transferCollapse" class="card-body {{ old('serviceTransferCost') ? '' : 'd-none' }}">
                        <div class="form-group">
                            <label for="serviceTransferCost">Koszt przy płatności przelewem</label>
                            <input type="text" class="form-control @error('serviceTransferCost') is-invalid @enderror" id="serviceTransferCost" name="serviceTransferCost" value="{{ old('serviceTransferCost') }}">
                            @error('serviceTransferCost')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="card border-primary mt-3">
                    <div class="card-header bg-primary text-white">
                        <div class="custom-control custom-switch text-center">
                            <input type="checkbox" class="custom-control-input" id="servicePaymentPaypal" data-collapse-target="paypalCollapse" {{ old('servicePaypalCost') ? 'checked' : '' }}>
                            <label class="custom-control-label" for="servicePaymentPaypal">Płatności PayPal</label>
                        </div>
                    </div>
                    <div id="paypalCollapse" class="card-body {{ old('servicePaypalCost') ? '' : 'd-none' }}">
                        <div class="form-group">
                            <label for="servicePaypalCost">Koszt przy płatności PayPal</label>
                            <input type="text" class="form-control @error('servicePaypalCost') is-invalid @enderror" id="servicePaypalCost" name="servicePaypalCost" value="{{ old('servicePaypalCost') }}">
                            @error('servicePaypalCost')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 text-center">
                <button type="submit" class="btn btn-success my-5"><i class="fas fa-plus"></i> Dodaj usługę</button>
            </div>
        </div>
    </form>
@endsection
