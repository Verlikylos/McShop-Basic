@extends('admin.components.layout')

@section('acp-card-title')
    <h4 class="acp-card-title">
        <i class="fas fa-server"></i> Tworzenie nowego serwera
    </h4>
    <a href="{{ route('admin.servers.index') }}" class="btn btn-outline-secondary"><i class="fas fa-times"></i> Anuluj</a>
@endsection

@section('content')
    <form method="POST" action="{{ route('admin.servers.store') }}" enctype="multipart/form-data">
        @csrf
        @method('POST')

        <div class="row">
            <div class="col-12 col-md-8 col-lg-4 mx-auto">
                <div class="form-group">
                    <label for="serverName">Nazwa serwera</label>
                    <input type="text" class="form-control @error('serverName') is-invalid @enderror" id="serverName" name="serverName" value="{{ old('serverName') }}">
                    @error('serverName')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="serverDisplayAddress">Wyświetlany adres serwera</label>
                    <input type="text" class="form-control @error('serverDisplayAddress') is-invalid @enderror" id="serverDisplayAddress" name="serverDisplayAddress" value="{{ old('serverDisplayAddress') }}">
                    @error('serverDisplayAddress')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
                <h6 class="mt-1">Obrazek serwera</h6>
                <div class="custom-file">
                    <input type="file" class="custom-file-input @error('serverImage') is-invalid @enderror" id="serverImage" name="serverImage"  accept=".jpg,.jpeg,.png">
                    <label class="custom-file-label" for="serverImage">Wybierz plik...</label>
                    @error('serverImage')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group mt-3">
                    <label for="serverConnectionMethod">Metoda połączenia z serwerem</label>
                    <select class="form-control @error('serverConnectionMethod') is-invalid @enderror" id="serverConnectionMethod" name="serverConnectionMethod">
                        <option value="api" {{ old('serverConnectionMethod') === 'api' ? 'selected' : '' }}>REST API</option>
                        <option value="rcon" {{ old('serverConnectionMethod') === 'rcon' ? 'selected' : '' }}>RCON</option>
                    </select>
                    @error('serverImage')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
                <div id="serverMethodRcon" class="{{ old('serverConnectionMethod') === 'api' ? 'd-none' : (old('serverConnectionMethod') !== 'rcon' ? 'd-none' : '' )}}">
                    <div class="form-group">
                        <label for="serverIpAddress">Adres IP serwera</label>
                        <input type="text" class="form-control @error('serverIpAddress') is-invalid @enderror" id="serverIpAddress" name="serverIpAddress" value="{{ old('serverIpAddress') }}">
                        @error('serverIpAddress')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="serverPort">Port serwera</label>
                        <input type="text" class="form-control @error('serverPort') is-invalid @enderror" id="serverPort" name="serverPort" value="{{ old('serverPort') }}">
                        @error('serverPort')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="serverRconPort">Port RCON serwera</label>
                        <input type="text" class="form-control @error('serverRconPort') is-invalid @enderror" id="serverRconPort" name="serverRconPort" value="{{ old('serverRconPort') }}">
                        @error('serverRconPort')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="serverRconPassword">Hasło RCON serwera</label>
                        <input type="text" class="form-control @error('serverRconPassword') is-invalid @enderror" id="serverRconPassword" name="serverRconPassword" value="{{ old('serverRconPassword') }}">
                        @error('serverRconPassword')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div id="serverMethodApi" class="{{ old('serverConnectionMethod') === 'rcon' ? 'd-none' : '' }}">
                    <div class="form-group">
                        <label for="serverApiAddress">Adres API serwera</label>
                        <input type="text" class="form-control @error('serverApiAddress') is-invalid @enderror" id="serverApiAddress" name="serverApiAddress" value="{{ old('serverApiAddress') }}">
                        @error('serverApiAddress')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="serverApiKey">Klucz API serwera</label>
                        <input type="text" class="form-control @error('serverApiKey') is-invalid @enderror" id="serverApiKey" name="serverApiKey" value="{{ old('serverApiKey') }}">
                        @error('serverApiKey')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="col-12 text-center">
                <button type="submit" class="btn btn-success my-5"><i class="fas fa-plus"></i> Dodaj serwer</button>
            </div>
        </div>
    </form>
@endsection
