@extends('admin.components.layout')

@section('title', 'Usługi z serwera ' . $activeServer->getName())

@section('acp-card-title')
    <h1>
        <i class="fas fa-cubes"></i>
        Usługi z serwera <span class="font-weight-bold">{{ $activeServer->getName() . ' (ID: #' . $activeServer->getId() . ')' }}</span>
    </h1>
@endsection

@section('content')
    <table class="table table-hover table-centered table-responsive-lg">
        <thead>
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
                    <td >
                        @if (!(($services->currentPage() == 1) && ($service->getId() == $services->first()->getId())))
                            <a class="btn btn-table" href="{{ route('admin.services.swap', ['service' => $service->getSlug(), 'up' => 1]) }}" data-toggle="tooltip" data-placement="top" title="Przesuń w górę">
                                <i class="fas fa-arrow-up fa-fw"></i>
                            </a>
                        @endif

                        @if (!(($services->currentPage() == $services->lastPage()) && ($service->getId() == $services->last()->getId())))
                            <a class="btn btn-table" href="{{ route('admin.services.swap', ['service' => $service->getSlug(), 'up' => 0]) }}" data-toggle="tooltip" data-placement="top" title="Przesuń w dół">
                                <i class="fas fa-arrow-down fa-fw"></i>
                            </a>
                        @endif
                    </td>
                    <td>
                        <div class="form-check form-switch">
                            <input class="form-check-input switch-input-redirect" type="checkbox" id="{{ 'service' . $service->getId() . 'ActiveSwitch' }}" data-switch-target="{{ route('admin.services.active.toggle', $service->getSlug()) }}" {{ $service->isActive() ? 'checked' : '' }}>
                            <label class="form-check-label" for="{{ 'service' . $service->getId() . 'ActiveSwitch' }}"></label>
                        </div>
                    </td>
                    <td>
                        <a class="btn btn-table" href="{{ route('admin.services.edit', $service->getSlug()) }}" data-toggle="tooltip" data-placement="top" title="Edytuj">
                            <i class="fas fa-edit fa-fw"></i>
                        </a>
                        <button class="btn btn-table entity-delete-btn" data-entity-name="{{ $service->getName() . ' (ID: #' . $service->getId() . ')' }}" data-target="{{ route('admin.services.delete', $service->getSlug()) }}" data-toggle="tooltip" data-placement="top" title="Usuń">
                            <i class="fas fa-times fa-fw"></i>
                        </button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    {{ $services->links() }}
@endsection

@section('modals')
    @include('admin.components.entity_delete_confirmation_modal')
@endsection
