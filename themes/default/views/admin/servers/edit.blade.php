@extends('admin.components.layout', ['withJasnyBootstrap' => true])

@section('title', 'Edycja serwera ' . $server->getName())

@section('acp-card-title')
    <h1>
        <i class="fas fa-edit"></i>
        Edycja serwera
        <span class="font-weight-bold">{{ $server->getName() . ' (ID: #' . $server->getId() . ')' }}</span>
    </h1>
@endsection
@section('content')
    <form method="POST" action="{{ route('admin.servers.update', $server->getSlug()) }}" enctype="multipart/form-data">
        @csrf
        @method('PATCH')

        <div class="row">
            <div class="col-12 col-md-6">
                <div class="form-group mb-3">
                    <input type="text" class="form-control @error('serverName') is-invalid @enderror" id="serverName" name="serverName" value="{{ old('serverName') ?? $server->getName() }}" required disabled>
                    <label class="form-label" for="serverName">Nazwa serwera</label>
                    @error('serverName')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group mb-3">
                    <input type="text" class="form-control @error('serverDisplayAddress') is-invalid @enderror" id="serverDisplayAddress" name="serverDisplayAddress" value="{{ old('serverDisplayAddress') ?? $server->getDisplayAddress() }}" required>
                    <label class="form-label" for="serverDisplayAddress">Wyświetlany adres serwera</label>
                    @error('serverDisplayAddress')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-file-with-preview form-group mb-3">
                    <div class="file-preview">
                        <img class="img-fluid file-preview-image" src="{{ $server->getImageUrl() }}" alt="File preview">
                    </div>
                    <div class="form-file">
                        <input type="file" class="form-file-input" id="serverImage" name="serverImage" accept=".jpg,.jpeg,.png">
                        <label class="form-file-label" for="serverImage">
                            <span class="form-file-text">Wybierz plik...</span>
                            <span class="form-file-button">Wybierz</span>
                        </label>
                        <label class="form-label" for="serverImage">Obrazek serwera</label>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-6">
                <div class="form-group mb-3">
                    <select class="form-select selectpicker @error('serverConnectionMethod') is-invalid @enderror" id="serverConnectionMethod" name="serverConnectionMethod" required>
                        <option value="" disabled {{ !in_array(old('serverConnectionMethod'), ['api', 'rcon']) ? 'selected' : '' }}>Wybierz opcję...</option>
                        <option
                            value="api"
                            {{ old('serverConnectionMethod') ? (old('serverConnectionMethod') === 'api' ? 'selected' : '') : ($server->getConnectionMethod() === 'api' ? 'selected' : '') }}
                        >
                            REST API
                        </option>
                        <option
                            value="rcon"
                            {{ old('serverConnectionMethod') ? (old('serverConnectionMethod') === 'rcon' ? 'selected' : '') : ($server->getConnectionMethod() === 'rcon' ? 'selected' : '') }}
                        >
                            RCON
                        </option>
                    </select>
                    <label class="form-label" for="serverConnectionMethod">Metoda połączenia z serwerem</label>
                    @error('serverConnectionMethod')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                <div
                    id="serverConnectionMethodRconWrapper"
                    class="{{ old('serverConnectionMethod') ? (old('serverConnectionMethod') === 'rcon' ? '' : 'd-none') : ($server->getConnectionMethod() === 'rcon' ? '' : 'd-none') }}"
                >
                    <div class="form-group mb-3">
                        <input type="text" class="form-control @error('serverIpAddress') is-invalid @enderror" id="serverIpAddress" name="serverIpAddress" value="{{ old('serverIpAddress') ?? $server->getIpAddress() }}">
                        <label class="form-label" for="serverIpAddress">Adres IP serwera</label>
                        @error('serverIpAddress')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group mb-3">
                        <input type="text" class="form-control @error('serverPort') is-invalid @enderror" id="serverPort" name="serverPort" value="{{ old('serverPort') ?? $server->getPort() }}">
                        <label class="form-label" for="serverPort">Port Query serwera</label>
                        @error('serverPort')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group mb-3">
                        <input type="text" class="form-control @error('serverRconPort') is-invalid @enderror" id="serverRconPort" name="serverRconPort" value="{{ old('serverRconPort') ?? $server->getRconPort() }}">
                        <label class="form-label" for="serverRconPort">Port RCON serwera</label>
                        @error('serverRconPort')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group mb-3">
                        <input type="text" class="form-control @error('serverRconPassword') is-invalid @enderror" id="serverRconPassword" name="serverRconPassword" value="{{ old('serverRconPassword') ?? $server->getRconPassword() }}">
                        <label class="form-label" for="serverRconPassword">Hasło RCON serwera</label>
                        @error('serverRconPassword')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div
                    id="serverConnectionMethodApiWrapper"
                    class="{{ old('serverConnectionMethod') ? (old('serverConnectionMethod') === 'api' ? '' : 'd-none') : ($server->getConnectionMethod() === 'api' ? '' : 'd-none') }}"
                >
                    <div class="form-group mb-3">
                        <input type="text" class="form-control @error('serverApiAddress') is-invalid @enderror" id="serverApiAddress" name="serverApiAddress" value="{{ old('serverApiAddress') ?? $server->getApiAddress() }}">
                        <label class="form-label" for="serverApiAddress">Adres API serwera</label>
                        @error('serverApiAddress')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group mb-3">
                        <input type="text" class="form-control @error('serverApiKey') is-invalid @enderror" id="serverApiKey" name="serverApiKey" value="{{ old('serverApiKey') ?? $server->getApiKey() }}">
                        <label class="form-label" for="serverApiKey">Klucz API serwera</label>
                        @error('serverApiKey')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12 text-center">
                <button type="submit" class="btn btn-success mt-5 form-group mb-3">
                    <i class="fas fa-check"></i> Zapisz zmiany
                </button>
            </div>
        </div>
    </form>
@endsection
