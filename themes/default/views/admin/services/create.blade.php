@extends('admin.components.layout')

@section('title', 'Tworzenie nowej usługi')

@section('acp-card-title')
    <h1>
        <i class="fas fa-cubes"></i>
        Tworzenie nowej usługi
    </h1>
@endsection

@section('content')
    <form id="createServiceForm" method="POST" action="{{ route('admin.services.store') }}" enctype="multipart/form-data">
        @csrf
        @method('POST')

        <div class="row">
            <div class="col-12 col-md-6">
                <div class="form-group mb-3">
                    <input type="text" class="form-control @error('serviceName') is-invalid @enderror" id="serviceName" name="serviceName" value="{{ old('serviceName') }}" required>
                    <label class="form-label" for="serviceName">Nazwa usługi</label>
                    @error('serviceName')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group mb-3">
                    <select class="form-select @error('serviceServer') is-invalid @enderror" id="serviceServer" name="serviceServer" required>
                        <option value="" selected disabled>Wybierz serwer...</option>
                        @foreach ($servers as $server)
                            <option value="{{ $server->getId() }}" {{ old('serviceServer') == $server->getId() ? 'selected' : '' }}>{{ 'Serwer ' . $server->getName() . ' (ID: #' . $server->getId() . ')' }}</option>
                        @endforeach
                    </select>
                    <label class="form-label" for="serviceServer">Serwer</label>
                    @error('serviceServer')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-file-with-preview form-group mb-3">
                    <div class="file-preview">
                        <img class="img-fluid file-preview-image" src="https://via.placeholder.com/500x500?text=Wybierz%20obrazek..." alt="File preview">
                    </div>
                    <div class="form-file">
                        <input type="file" class="form-file-input" id="serviceImage" name="serviceImage" accept=".jpg,.jpeg,.png">
                        <label class="form-file-label" for="serverImage">
                            <span class="form-file-text">Wybierz plik...</span>
                            <span class="form-file-button">Wybierz</span>
                        </label>
                        <label class="form-label" for="serviceImage">Obrazek usługi</label>
                    </div>
                </div>
                <div class="mb-3">
                    <label class="" for="serviceDescription">Opis usługi</label>
                    <textarea id="serviceDescription" name="serviceDescription" rows="3">{{ old('serviceDescription') }}</textarea>
                </div>
                <ul class="list-group list-group-thick mb-3">
                    <li class="list-group-item">
                        <div class="form-check">
                            <label class="form-check-label" for="serviceRequiresPlayer">
                                Wymagaj gracza online
                            </label>
                            <input class="form-check-input" type="checkbox" id="serviceRequiresPlayer" name="serviceRequiresPlayer" {{ old('serviceRequiresPlayer') ? 'checked' : '' }}
                        </div>
                    </li>
                </ul>
            </div>

            <div class="col-12 col-md-6">

                <div class="card shadow mb-4">
                    <div class="card-header bg-primary text-white d-flex align-items-center justify-content-between py-3">
                        <h6 class="mb-0">
                            <i class="fas fa-mobile-alt"></i>
                            Płatność SMS Premium
                        </h6>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="servicePaymentSmsNumber" {{ old('serviceSmsNumber') ? 'checked' : '' }}>
                            <label class="form-check-label" for="servicePaymentSmsNumber"></label>
                        </div>
                    </div>
                    <div class="card-body py-4">
                        <div class="form-group">
                            <select class="form-select @error('serviceServer') is-invalid @enderror" id="serviceSmsNumber" name="serviceSmsNumber">
                                <option value="" selected disabled>Wybierz numer...</option>
                                @foreach ($numbers as $number)
                                    <option value="{{ $number->getId() }}" {{ old('serviceSmsNumber') == $number->getId() ? 'selected' : '' }}>{{ $number->getNumber() . ' — ' . $number->getNettoCostFormatted() . ' (' .$number->getBruttoCostFormatted() . ' z VAT)' }}</option>
                                @endforeach
                            </select>
                            <label class="form-label" for="serviceSmsNumber">Numer SMS</label>
                            @error('serviceSmsNumber')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="card shadow mb-4">
                    <div class="card-header bg-primary text-white d-flex align-items-center justify-content-between py-3">
                        <h6 class="mb-0">
                            <i class="fas fa-lock"></i>
                            Płatność PaySafeCard
                        </h6>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="servicePaymentPsc" {{ old('servicePscCost') ? 'checked' : '' }}>
                            <label class="form-check-label" for="servicePaymentPsc"></label>
                        </div>
                    </div>
                    <div class="card-body py-4">
                        <div class="form-group">
                            <input type="text" class="form-control @error('servicePscCost') is-invalid @enderror" id="servicePscCost" name="servicePscCost" value="{{ old('servicePscCost') }}">
                            <label class="form-label" for="servicePscCost">Koszt przy płatności PaySafeCard</label>
                            @error('servicePscCost')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="card shadow mb-4">
                    <div class="card-header bg-primary text-white d-flex align-items-center justify-content-between py-3">
                        <h6 class="mb-0">
                            <i class="fas fa-credit-card"></i>
                            Płatność przelewem
                        </h6>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="serviceTransferPsc" {{ old('serviceTransferCost') ? 'checked' : '' }}>
                            <label class="form-check-label" for="serviceTransferPsc"></label>
                        </div>
                    </div>
                    <div class="card-body py-4">
                        <div class="form-group">
                            <input type="text" class="form-control @error('serviceTransferCost') is-invalid @enderror" id="serviceTransferCost" name="serviceTransferCost" value="{{ old('serviceTransferCost') }}">
                            <label class="form-label" for="serviceTransferCost">Koszt przy płatności przelewem</label>
                            @error('serviceTransferCost')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="card shadow mb-4">
                    <div class="card-header bg-primary text-white d-flex align-items-center justify-content-between py-3">
                        <h6 class="mb-0">
                            <i class="fab fa-paypal"></i>
                            Płatność PayPal
                        </h6>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="servicePayPalPsc" {{ old('servicePayPalCost') ? 'checked' : '' }}>
                            <label class="form-check-label" for="servicePayPalPsc"></label>
                        </div>
                    </div>
                    <div class="card-body py-4">
                        <div class="form-group">
                            <input type="text" class="form-control @error('servicePaypalCost') is-invalid @enderror" id="servicePaypalCost" name="servicePaypalCost" value="{{ old('servicePaypalCost') }}">
                            <label class="form-label" for="servicePaypalCost">Koszt przy płatności PayPal</label>
                            @error('servicePaypalCost')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="mb-3">
                    <span class="form-label mb-2 d-block">Komendy do wykonania</span>


                    <div id="serviceCommandsWrapper">
                        @if (old('serviceCommands'))
                            @php ($lp = 1)

                            @foreach (old('serviceCommands') as $input)
                                <div class="form-group mb-3">
                                    <input
                                        type="text" class="form-control serviceCommandInput @error('serviceCommands') is-invalid @enderror" id="serviceCommand{{ $lp }}"
                                        name="serviceCommands[command{{ $lp }}]" data-lp="{{ $lp }}" value="{{ $input }}" {{ $lp == 1 ? 'required' : '' }}
                                    >
                                    <label for="serviceCommand{{ $lp }}" class="form-label">Komenda #{{ $lp }}</label>
                                </div>

                                @php ($lp++)
                            @endforeach
                        @else
                            <div class="form-group mb-3">
                                <input type="text" class="form-control serviceCommandInput @error('serviceCommands') is-invalid @enderror" id="serviceCommand1" name="serviceCommands[command1]" data-lp="1" required>
                                <label for="serviceCommand1" class="form-label">Komenda #1</label>
                            </div>
                        @endif
                    </div>

                    @error('serviceCommands')
                    <span class="invalid-feedback d-block mb-3">{{ $message }}</span>
                    @enderror

                    <button type="button" id="addCommandButton" class="btn btn-outline-primary btn-block mb-2">Dodaj komendę</button>
                </div>
            </div>

            <div class="col-12 text-center">
                <button type="submit" class="btn btn-success my-5"><i class="fas fa-plus"></i> Dodaj usługę</button>
            </div>
        </div>
    </form>
@endsection
