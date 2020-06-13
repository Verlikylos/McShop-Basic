@extends('admin.components.layout')

@section('title', 'Generator voucherów')

@section('acp-card-title')
    <h4 class="acp-card-title">
        <i class="fas fa-cogs"></i> Generator voucherów
    </h4>
    <a href="{{ route('admin.vouchers.index') }}" class="btn btn-outline-secondary"><i class="fas fa-times"></i> Anuluj</a>
@endsection

@section('content')
    <form method="POST" action="{{ route('admin.vouchers.store') }}">
        @csrf
        @method('POST')
        
        <div class="row">
            <div class="col-12 col-md-8 col-lg-4 mx-auto">
                <div class="form-group mt-3">
                    <label for="voucherService">Usługa</label>
                    <select class="selectpicker @error('voucherService') is-invalid @enderror" id="voucherService" name="voucherService" required>
                        <option value="">Wybierz usługę...</option>
                        @foreach ($services as $service)
                            <option value="{{ $service->getId() }}" {{ old('voucherService') == $service->getId() ? 'selected' : '' }}>{{ 'Usługa ' . $service->getName() . ' (ID: #' . $service->getId() . ') z serwera ' . $service->getServer()->getName() . ' (ID: #' . $service->getServer()->getId() . ')' }}</option>
                        @endforeach
                    </select>
                    @error('voucherService')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
                
                <div class="form-group">
                    <label for="voucherUsagesAmount">
                        Ilość użyć vouchera
                        <i class="fas fa-info-circle text-muted ml-1" data-toggle="tooltip" data-title="Ile razy jeden kod vouchera może być użyty."></i>
                    </label>
                    <input type="number" class="form-control @error('voucherUsagesAmount') is-invalid @enderror" id="voucherUsagesAmount" name="voucherUsagesAmount" value="{{ old('voucherUsagesAmount') ?? 1 }}" required>
                    @error('voucherUsagesAmount')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
    
                <div id="voucherManyUsagesPerPlayerWrapper" class="custom-control custom-checkbox text-center d-none mt-4 mb-3">
                    <input type="checkbox" class="custom-control-input" id="voucherManyUsagesPerPlayer" name="voucherManyUsagesPerPlayer">
                    <label class="custom-control-label" for="voucherManyUsagesPerPlayer">
                        Wiele użyć dla jednego gracza
                        <i class="fas fa-info-circle text-muted ml-2" data-toggle="tooltip" data-title="Czy dozwolone jest, aby gracz skorzystał z vouchera kilka razy."></i>
                    </label>
                </div>
                
                <div class="form-group">
                    <label for="voucherCodePrefix">Prefix vouchera</label>
                    <input type="text" class="form-control @error('voucherCodePrefix') is-invalid @enderror" id="voucherCodePrefix" name="voucherCodePrefix" value="{{ old('voucherCodePrefix') ?? setting('voucher_default_prefix') }}">
                    @error('voucherCodePrefix')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
                
                <div class="form-group">
                    <label for="voucherCodeLength">Długość kodu vouchera</label>
                    <input type="number" class="form-control @error('voucherCodeLength') is-invalid @enderror" id="voucherCodeLength" name="voucherCodeLength" value="{{ old('voucherCodeLength') ?? setting('voucher_default_code_length') }}" required>
                    @error('voucherCodeLength')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
                
                <div class="form-group">
                    <label for="voucherAmount">Ilość voucherów do wygenerowania</label>
                    <input type="number" class="form-control @error('voucherAmount') is-invalid @enderror" id="voucherAmount" name="voucherAmount" value="{{ old('voucherAmount') ?? 1 }}" required>
                    @error('voucherAmount')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12 text-center">
                <button type="submit" class="btn btn-success my-5"><i class="fas fa-cogs"></i> Wygeneruj voucher(y)</button>
            </div>
        </div>
    </form>
@endsection
