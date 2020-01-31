@extends('admin.components.layout')

@section('title', 'Ustawienia ogólne')

@section('acp-card-title')
    <div class="d-flex flex-row w-75">
        <h4 class="acp-card-title">
            <i class="fas fa-tools"></i> Ustawienia ogólne
        </h4>
    </div>
@endsection

@section('content')
    <div class="row">
        <div class="col-12 col-md-8 col-lg-4 mx-auto">
            <form method="POST" action="{{ route('admin.settings.general.update') }}">
                @csrf
                @method('PATCH')
    
                <div class="form-group">
                    <label for="settingPageTitle">Tytuł strony</label>
                    <input type="text" class="form-control @error('settingPageTitle') is-invalid @enderror" id="settingPageTitle" name="settingPageTitle" value="{{ setting('general_page_title') }}">
                    <small class="form-text text-muted">Używany w tagu &lt;title&gt;. Pojawia się w nazwie karty przeglądarki.</small>
                    @error('settingPageTitle')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="settingPageDescription">Opis strony</label>
                    <textarea class="form-control" name="settingPageDescription" id="settingPageDescription">{{ setting('general_page_description') }}</textarea>
                    <small class="form-text text-muted">Wyświetlany przez wyszukiwarki internetowe.</small>
                    @error('settingPageDescription')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="settingPageTags">Tagi strony</label>
                    <input type="text" class="form-control @error('settingPageTags') is-invalid @enderror" id="settingPageTags" name="settingPageTags" value="{{ setting('general_page_tags') }}">
                    <small class="form-text text-muted">Pozycjonują stronę w wyszukiwarce internetowej. Oddzielane przecinkami bez spacji.</small>
                    @error('settingPageTags')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="settingFavicon">Ikona ulubionych</label>
                    <input type="text" class="form-control @error('settingFavicon') is-invalid @enderror" id="settingFavicon" name="settingFavicon" value="{{ setting('general_page_favicon') }}">
                    <small class="form-text text-muted">Link do ikony o wymiarach 16x16. Wyświetlana ona jest obok nazwy karty przeglądarki oraz po dodaniu strony do zakładek. Najlepiej użyć ścieżki bezwzględnej do obrazka.</small>
                    @error('settingFavicon')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="settingPageLogo">Logo strony</label>
                    <input type="text" class="form-control @error('settingPageLogo') is-invalid @enderror" id="settingPageLogo" name="settingPageLogo" value="{{ setting('general_page_logo') }}">
                    <small class="form-text text-muted">Link do loga, które wyświetlane jest w lewym górnym rogu, na każdej stronie. Najlepiej użyć ścieżki bezwzględnej do obrazka. Można też wpisać zwykły tekst, wtedy zostanie on wyświetlony zamiast obrazka.</small>
                    @error('settingPageLogo')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="settingPageBackground">Tło strony</label>
                    <input type="text" class="form-control @error('settingPageBackground') is-invalid @enderror" id="settingPageBackground" name="settingPageBackground" value="{{ setting('general_page_background') }}">
                    <small class="form-text text-muted">Link do obrazka, który pojawi się w tle strony. Najlepiej użyć ścieżki bezwzględnej. Można też użyć koloru zapisanego w postaci heksadecymalnej (Razem z poprzedzającym hashem. Przykład "#2c3e50").</small>
                    @error('settingPageBackground')
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
