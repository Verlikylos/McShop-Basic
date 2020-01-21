@extends('admin.components.layout')

@section('acp-card-title')
    <h4 class="acp-card-title">
        <i class="fas fa-cubes"></i> Usługi
    </h4>
    <a href="#" class="btn btn-primary"><i class="fas fa-plus"></i> Dodaj usługę</a>
@endsection

@section('content')
    <section class="paginated-table-wrapper">
        <table id="servicesTable" class="table table-striped table-centered table-responsive-lg">
            <thead class="thead-dark">
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Nazwa</th>
                <th scope="col">Serwer</th>
                <th scope="col">Kolejność</th>
                <th scope="col">Aktywny</th>
                <th scope="col"></th>
            </tr>
            </thead>
            <tbody>
            @foreach ($services as $service)
                <tr>
                    <th scope="row">#{{ $service->getId() }}</th>
                    <td>{{ $service->getName() }}</td>
                    <td>{!! '<a href="' . route('admin.servers.edit', $service->getServer()->getId()) . '">Serwer ' . $service->getServer()->getName() . ' (ID: #' . $service->getServer()->getId() . ')</a>' !!}</td>
                    <td class="td-actions">
                        @if (!(($services->currentPage() == 1) && ($service->getId() == $services->first()->getId())))
                            <a class="btn btn-primary" href="{{ route('admin.servers.swap', ['server' => $service->getId(), 'up' => 1]) }}" data-toggle="tooltip" data-placement="top" title="Przesuń w górę">
                                <i class="fas fa-chevron-up fa-fw"></i>
                            </a>
                        @endif
                        
                        @if (!(($services->currentPage() == $services->lastPage()) && ($service->getId() == $services->last()->getId())))
                            <a class="btn btn-primary" href="{{ route('admin.servers.swap', ['server' => $service->getId(), 'up' => 0]) }}" data-toggle="tooltip" data-placement="top" title="Przesuń w dół">
                                <i class="fas fa-chevron-down fa-fw"></i>
                            </a>
                        @endif
                    </td>
                    <td>
                        <div class="custom-control custom-switch">
                            <input type="checkbox" class="custom-control-input serviceActiveStatusSwitch" id="{{ 'service' . $service->getId() . 'ActiveSwitch' }}" data-target="{{ route('admin.servers.active.toggle', $service->getId()) }}" {{ $service->isActive() ? 'checked' : '' }}>
                            <label class="custom-control-label" for="{{ 'service' . $service->getId() . 'ActiveSwitch' }}"></label>
                        </div>
                    </td>
                    <td class="td-actions">
                        <a class="btn btn-info" href="{{ route('admin.servers.edit', $service->getId()) }}" data-toggle="tooltip" data-placement="top" title="Edytuj">
                            <i class="fas fa-edit fa-fw"></i>
                        </a>
                        <button class="btn btn-danger service-delete-btn" data-service-name="{{ $service->getName() . ' (ID: #' . $service->getId() . ')' }}" data-href="{{ route('admin.servers.delete', $service->getId()) }}" data-toggle="tooltip" data-placement="top" title="Usuń">
                            <i class="fas fa-times fa-fw"></i>
                        </button>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </section>
    
    {{ $services->links() }}
@endsection

@section('modals')
    <div class="modal fade" id="serviceDeleteConfirmationModal" tabindex="-1" role="dialog" aria-labelledby="serviceDeleteConfirmationModalTitle" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="serviceDeleteConfirmationModalTitle">
                        <i class="fas fa-exclamation-triangle"></i>
                        Potwierdź usunięcie usługi <span class="service-modal-delete-server-name-variable font-weight-bold"></span>!
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Usunięcie tej usługi spowoduje również usunięcie wszelkich voucherów oraz historii zakupów z nią powiązanych! Operacji tej nie można później cofnąć.
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Anuluj</button>
                    <a id="modalServerDeleteBtnElement" class="btn btn-danger">Tak, usuń usługę <span class="service-modal-delete-server-name-variable font-weight-bold"></span>!</a>
                </div>
            </div>
        </div>
    </div>
@endsection
