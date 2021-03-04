@extends('admin.components.layout')

@section('title', 'Własne strony')

@section('acp-card-title')
    <h4 class="acp-card-title">
        <i class="fas fa-file-code"></i> Własne strony
    </h4>
    <a href="{{ route('admin.pages.index') }}" class="btn btn-outline-secondary"><i class="fas fa-times"></i> Anuluj</a>
@endsection

@section('content')
    <form id="createPageForm" method="POST" action="{{ route('admin.pages.store') }}">
        @csrf
        
        <div class="row">
            <div class="col-12 col-md-8 col-lg-4 mx-auto">
                <div class="form-group">
                    <label for="pageName">Nazwa strony</label>
                    <input type="text" class="form-control @error('pageName') is-invalid @enderror" id="pageName" name="pageName" value="{{ old('pageName') }}" required>
                    @error('pageName')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
                
                <div class="form-group">
                    <label for="pageIcon">Ikona strony</label>
                    <input type="text" class="form-control @error('pageIcon') is-invalid @enderror" id="pageIcon" name="pageIcon" value="{{ old('pageIcon') }}">
                    <small class="text-muted">
                        Przykład:
                        <code>fas fa-check</code>
                    </small>
                    @error('pageIcon')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
    
                <div class="form-group mt-3">
                    <label for="pageType">Typ strony</label>
                    <select class="selectpicker @error('pageType') is-invalid @enderror" id="pageType" name="pageType" required>
                        <option value="">Wybierz opcję...</option>
                        <option value="PAGE" {{ old('pageType') == 'PAGE' ? 'selected' : '' }}>Strona</option>
                        <option value="LINK" {{ old('pageType') == 'LINK' ? 'selected' : '' }}>Link</option>
                    </select>
                    @error('pageType')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
            </div>
        </div>
        <div class="row">
            <div id="pageContentTypeEditor" class="col-12 {{ old('pageType') == 'PAGE' ? '' : 'd-none' }}">
                <span>Treść strony</span>
                <div id="pageContentEditor"></div>
                <input type="hidden" id="pageContent" name="pageContent" value="{{ old('pageContent') }}">
            </div>
            <div id="pageContentTypeLink" class="col-12 col-md-8 col-lg-4 mx-auto {{ old('pageType') == 'LINK' ? '' : 'd-none' }}">
                <div class="form-group">
                    <label for="pageLink">Adres do przekierowania</label>
                    <input type="text" class="form-control @error('pageLink') is-invalid @enderror" id="pageLink" name="pageLink" value="{{ old('pageLink') }}">
                    @error('pageLink')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12 text-center">
                <button type="submit" class="btn btn-success my-5"><i class="fas fa-plus"></i> Dodaj stronę</button>
            </div>
        </div>
    </form>
@endsection
