@extends('components.layout')

@section('title', 'Sklep serwera ' . $server->getName())

@section('breadcrumb')
    <li class="breadcrumb-item active" aria-current="page">Sklep serwera {{ $server->getName() }}</li>
@endsection

@section('announcement')
    @if ($server->isAnnouncementEnabled())
        <div class="card shadow mt-3">
            <div class="card-body">
                {!! $server->getAnnouncementContentFormatted() !!}
            </div>
        </div>
    @endif
@endsection

@section('content')
    <div class="row">
        <div class="col-12 col-lg-8">
            <div class="card shadow">
                <div class="card-body">
                    <div class="shop-header">
                        <h4><i class="fas fa-shopping-basket"></i> Sklep serwera {{ $server->getName() }}</h4>
                        <button class="btn btn-primary"><i class="fas fa-ticket-alt"></i> Zrealizuj voucher</button>
                    </div>
                    <div class="row">
                        @foreach ($services as $service)
                            @include('components.vertical_service_card', [$service, $server])
                        @endforeach
                    </div>
    
                    {{ $services->links() }}
                </div>
            </div>
        </div>
        <div class="col-12 col-lg-4">
            @include('components.sidebar', $server)
        </div>
    </div>
@endsection
