@extends('admin.components.layout')

@section('title', 'Usługi z serwera ' . $activeServer->getName())

@section('acp-card-title')
    <div class="d-flex flex-row w-75">
        <h4 class="acp-card-title">
            <i class="fas fa-cubes"></i> Usługi
        </h4>
        <select data-target="{{ route('admin.services.index') }}" class="custom-select custom-select-sm entityActiveFilterSelect w-50 ml-2">
            @foreach($servers as $server)
                <option value="{{ $server->getId() }}" {{ $server->getId() == $activeServer->getId() ? 'selected' : '' }}>{{ 'z serwera ' . $server->getName() . ' (ID: #' . $server->getId() . ')' }}</option>
            @endforeach
        </select>
    </div>
    <a href="{{ route('admin.services.create') }}" class="btn btn-primary"><i class="fas fa-plus"></i> Dodaj usługę</a>
@endsection

@section('content')
    <section class="paginated-table-wrapper">
        <table id="servicesTable" class="table table-striped table-centered table-responsive-lg">
            <thead class="thead-dark">
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Nazwa</th>
                <th scope="col">Kolejność</th>
                <th scope="col">Aktywna</th>
                <th scope="col"></th>
            </tr>
            </thead>
            <tbody>
            @foreach ($services as $service)
                <tr>
                    <th scope="row">#{{ $service->getId() }}</th>
                    <td>{{ $service->getName() }}</td>
                    <td class="td-actions">
                        @if (!(($services->currentPage() == 1) && ($service->getId() == $services->first()->getId())))
                            <a class="btn btn-primary" href="{{ route('admin.services.swap', ['service' => $service->getSlug(), 'up' => 1]) }}" data-toggle="tooltip" data-placement="top" title="Przesuń w górę">
                                <i class="fas fa-chevron-up fa-fw"></i>
                            </a>
                        @endif
                        
                        @if (!(($services->currentPage() == $services->lastPage()) && ($service->getId() == $services->last()->getId())))
                            <a class="btn btn-primary" href="{{ route('admin.services.swap', ['service' => $service->getSlug(), 'up' => 0]) }}" data-toggle="tooltip" data-placement="top" title="Przesuń w dół">
                                <i class="fas fa-chevron-down fa-fw"></i>
                            </a>
                        @endif
                    </td>
                    <td>
                        <div class="custom-control custom-switch">
                            <input type="checkbox" class="custom-control-input entityActiveStatusSwitch" id="{{ 'service' . $service->getId() . 'ActiveSwitch' }}" data-target="{{ route('admin.services.active.toggle', $service->getSlug()) }}" {{ $service->isActive() ? 'checked' : '' }}>
                            <label class="custom-control-label" for="{{ 'service' . $service->getId() . 'ActiveSwitch' }}"></label>
                        </div>
                    </td>
                    <td class="td-actions">
                        <a class="btn btn-info" href="{{ route('admin.services.edit', $service->getSlug()) }}" data-toggle="tooltip" data-placement="top" title="Edytuj">
                            <i class="fas fa-edit fa-fw"></i>
                        </a>
                        <button class="btn btn-danger entity-delete-btn" data-entity-name="{{ $service->getName() . ' (ID: #' . $service->getId() . ')' }}" data-target="{{ route('admin.services.delete', $service->getSlug()) }}" data-toggle="tooltip" data-placement="top" title="Usuń">
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
    @include('admin.components.entity_delete_confirmation_modal')
@endsection
