@extends('admin.components.layout')

@section('title', 'Dodawanie numeru SMS')

@section('acp-card-title')
    <h4 class="acp-card-title">
        <i class="fas fa-sms"></i> Dodawanie numeru SMS
    </h4>
    <a href="{{ route('admin.settings.numbers.index') }}" class="btn btn-outline-secondary"><i class="fas fa-times"></i> Anuluj</a>
@endsection

@section('content')
    <form method="POST" action="{{ route('admin.settings.numbers.store') }}">
        @csrf
        @method('POST')
        
        <div class="row">
            <div class="col-12 col-md-8 col-lg-4 mx-auto">
                <div class="form-group">
                    <label for="numberOperator">Operator płatności</label>
                    <select class="form-control @error('numberOperator') is-invalid @enderror" id="numberOperator" name="numberOperator">
                        @foreach(config('mcshop.sms_operators') as $key => $value)
                            <option value="{{ $key }}" {{ old('numberOperator') == $key ? 'selected' : '' }}>{{ $value }}</option>
                        @endforeach
                    </select>
                    @error('numberOperator')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="numberNumber">Numer SMS</label>
                    <input type="text" class="form-control @error('numberNumber') is-invalid @enderror" id="numberNumber" name="numberNumber" value="{{ old('numberNumber') }}">
                    @error('numberNumber')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="numberNetto">Kosz netto wysłania SMSa</label>
                    <input type="number" class="form-control @error('numberNetto') is-invalid @enderror" id="numberNetto" name="numberNetto" value="{{ old('numberNetto') }}">
                    @error('numberNetto')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="numberBrutto">Kosz brutto wysłania SMSa</label>
                    <input type="text" class="form-control" id="numberBrutto" disabled>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12 text-center">
                <button type="submit" class="btn btn-success my-5"><i class="fas fa-plus"></i> Dodaj numer</button>
            </div>
        </div>
    </form>
@endsection
