@extends('admin.components.layout')

@section('title', 'Ustawienia widgetu Discord')

@section('acp-card-title')
    <h4 class="acp-card-title">
        <i class="fab fa-discord"></i> Ustawienia widgetu Discord
    </h4>
    <a href="{{ route('admin.settings.widget.index') }}" class="btn btn-outline-primary">
        <i class="fas fa-chevron-left"></i>
        Wróć
    </a>
@endsection

@section('content')
    <div class="row">
        <div class="col-12 col-md-8 col-lg-4 mx-auto">
            <form method="POST" action="{{ route('admin.settings.widget.discord.update') }}">
                @csrf
                @method('PATCH')
                
                <div class="form-group">
                    <label for="discordServerId">ID serwera Discord</label>
                    <input type="text" class="form-control @error('discordServerId') is-invalid @enderror" id="discordServerId" name="discordServerId" value="{{ setting('settings_widget_discord_server_id') }}" required>
                    @error('discordServerId')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
                
                <div class="form-group">
                    <label for="discordHeight">Wysokość widgetu Discord</label>
                    <input type="number" class="form-control @error('discordHeight') is-invalid @enderror" id="discordHeight" name="discordHeight" value="{{ setting('settings_widget_discord_height') }}" required>
                    @error('discordHeight')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
                
                <div class="form-group">
                    <label for="discordTheme">Motyw widgetu Discord</label>
                    <select class="selectpicker @error('discordTheme') is-invalid @enderror" id="discordTheme" name="discordTheme" required>
                        <option value="light" {{ setting('settings_widget_discord_theme') == 'light' ? 'selected' : '' }}>Jasny</option>
                        <option value="dark" {{ setting('settings_widget_discord_theme') == 'dark' ? 'selected' : '' }}>Ciemny</option>
                    </select>
                    @error('discordTheme')
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
