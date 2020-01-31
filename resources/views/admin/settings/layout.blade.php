@extends('admin.components.layout')

@section('title', 'Ustawienia ogólne')

@section('acp-card-title')
    <div class="d-flex flex-row w-75">
        <h4 class="acp-card-title">
            <i class="fas fa-object-group"></i> Ustawienia wyglądu
        </h4>
    </div>
@endsection

@section('content')
    <div class="row">
        <div class="col-12 col-md-8 col-lg-4 mx-auto">
            <form method="POST" action="{{ route('admin.settings.layout.update') }}">
                @csrf
                @method('PATCH')
    
                <div class="form-group">
                    <label for="layoutTheme">Motyw</label>
                    <select class="form-control @error('layoutTheme') is-invalid @enderror" id="layoutTheme" name="layoutTheme">
                        @foreach(config('mcshop.themes') as $theme)
                            @php($themeName = strtolower(str_replace([' ', '.io'], ['-', ''], $theme)))
                            <option value="{{ $themeName }}" {{ $themeName == setting('layout_theme') ? 'selected' : '' }}>{{ $theme }}</option>
                        @endforeach
                    </select>
                    @error('layoutTheme')
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
