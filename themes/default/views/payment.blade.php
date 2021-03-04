@extends('components.layout')

@section('title', 'Przekierowanie do płatności')

@section('breadcrumb')
    <li class="breadcrumb-item active" aria-current="page">Przekierowanie do płatności</li>
@endsection

@section('content')
    <div class="card shadow payment-redirect-card">
        <div class="card-body d-flex align-items-center justify-content-center flex-column">
            <h2>Trwa przekierowanie do płatności...</h2>
            
            <form action="{{ $formData['action'] }}" method="POST">
                @foreach (array_except($formData, 'action') as $field => $value)
                    <input type="hidden" name="{{ $field }}" value="{{ $value }}">
                @endforeach
                
                <button type="submit" class="btn btn-link">Kliknij tutaj, jeżeli przekierowanie nie nastąpiło automatycznie</button>
            </form>
        </div>
    </div>
@endsection
