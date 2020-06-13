@extends('admin.components.layout')

@section('title', 'Ustawienia widgetu Teamspeak')

@section('acp-card-title')
    <h4 class="acp-card-title">
        <i class="fab fa-teamspeak"></i> Ustawienia widgetu Teamspeak
    </h4>
    <a href="{{ route('admin.settings.widget.index') }}" class="btn btn-outline-primary">
        <i class="fas fa-chevron-left"></i>
        Wróć
    </a>
@endsection

@section('content')
    <div class="row">
        <div class="col-12 col-md-8 col-lg-4 mx-auto">
            <form method="POST" action="{{ route('admin.settings.widget.teamspeak.update') }}">
                @csrf
                @method('PATCH')
                
                <div class="form-group">
                    <label for="teamspeakAddress">Adres IP serwera Teamspeak</label>
                    <input type="text" class="form-control @error('teamspeakAddress') is-invalid @enderror" id="teamspeakAddress" name="teamspeakAddress" value="{{ setting('settings_widget_teamspeak_server_address') }}" required>
                    @error('teamspeakAddress')
                    <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
                
                <div class="form-group">
                    <label for="teamspeakPort">Port serwera Teamspeak</label>
                    <input type="text" class="form-control @error('teamspeakPort') is-invalid @enderror" id="teamspeakPort" name="teamspeakPort" value="{{ setting('settings_widget_teamspeak_server_port') }}" required>
                    @error('teamspeakPort')
                    <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
                
                <div class="form-group">
                    <label for="teamspeakDisplayAddress">Wyświetlany adres serwera Teamspeak</label>
                    <input type="text" class="form-control @error('teamspeakDisplayAddress') is-invalid @enderror" id="teamspeakDisplayAddress" name="teamspeakDisplayAddress" value="{{ setting('settings_widget_teamspeak_server_display_address') }}" required>
                    @error('teamspeakDisplayAddress')
                    <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
                
                <div class="form-group">
                    <label for="teamspeakQueryPort">Port Query serwera Teamspeak</label>
                    <input type="text" class="form-control @error('teamspeakQueryPort') is-invalid @enderror" id="teamspeakQueryPort" name="teamspeakQueryPort" value="{{ setting('settings_widget_teamspeak_server_query_port') }}" required>
                    @error('teamspeakQueryPort')
                    <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
                
                <div class="form-group">
                    <label for="teamspeakQueryUser">Login użytkownika Query</label>
                    <input type="text" class="form-control @error('teamspeakQueryUser') is-invalid @enderror" id="teamspeakQueryUser" name="teamspeakQueryUser" value="{{ setting('settings_widget_teamspeak_server_query_user') }}" required>
                    @error('teamspeakQueryUser')
                    <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
                
                <div class="form-group">
                    <label for="teamspeakQueryPassword">Hasło użytkownika Query</label>
                    <input type="text" class="form-control @error('teamspeakQueryPassword') is-invalid @enderror" id="teamspeakQueryPassword" name="teamspeakQueryPassword" value="{{ setting('settings_widget_teamspeak_server_query_password') }}" required>
                    @error('teamspeakQueryPassword')
                    <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
                
                <div class="text-center">
                    <button type="submit" class="btn btn-success my-5"><i class="fas fa-check"></i> Zapisz zmiany</button>
                </div>
            </form>
        </div>
    </div>
@endsection
