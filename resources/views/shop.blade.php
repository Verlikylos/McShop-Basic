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
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#voucherModal">
                            <i class="fas fa-ticket-alt"></i>
                            Zrealizuj voucher
                        </button>
                    </div>
                    <div class="row">
                        @if ($services->count() == 0)
                            <div class="col-12">
                                <h3 class="my-5 text-center">
                                    <i class="fas fa-exclamation-triangle"></i>
                                    Brak usług do wyświetlenia!
                                </h3>
                            </div>
                        @endif
                        
                        @foreach ($services as $service)
                            @include('components.horizontal_service_card', [$service, $server])
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

@section('modals')
    <div class="modal fade" id="voucherModal" tabindex="-1" role="dialog" aria-labelledby="voucherModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="voucherModalLabel">
                        <i class="fas fa-ticket-alt"></i>
                        Realizacja vouchera
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="voucherPlayerName">Nick gracza</label>
                        <input type="text" class="form-control" id="voucherPlayerName" name="voucherPlayerName">
                    </div>
                    <div class="form-group">
                        <label for="voucherCode">Kod vouchera</label>
                        <input type="text" class="form-control" id="voucherCode" name="voucherCode">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Anuluj</button>
                    <button type="button" class="btn btn-primary">Zrealizuj voucher</button>
                </div>
            </div>
        </div>
    </div>
@endsection
