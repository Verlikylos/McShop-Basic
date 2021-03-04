@extends('admin.components.layout')

@section('title', 'Serwery')

@section('acp-card-title')
    <h1>
        <i class="fas fa-server"></i> Serwery
    </h1>
@endsection

@section('content')
    <table class="table table-hover table-centered table-responsive-lg">
        <thead>
        <tr>
            <th scope="col">ID</th>
            <th scope="col">Nazwa</th>
            <th scope="col">Wyświetlany adres</th>
            <th scope="col">Metoda połączenia</th>
            <th scope="col">Kolejność</th>
            <th scope="col">Aktywny</th>
            <th scope="col"></th>
        </tr>
        </thead>
        <tbody>
            @php
                $hasFirst = false;
                $hasLast = false;
            @endphp
            @foreach ($servers as $index => $server)
                <tr>
                    <th scope="row">#{{ $server->getId() }}</th>
                    <td>{{ $server->getName() }}</td>
                    <td>{{ $server->getDisplayAddress() }}</td>
                    <td>{!! $server->getConnectionMethod() == 'api' ? '<span class="badge bg-success">API</span>' : '<span class="badge bg-warning">RCON</span>' !!}</td>
                    <td>
                        @if (!(($servers->currentPage() == 1) && ($server->getId() == $servers->first()->getId())))
                            <a class="btn btn-table" href="{{ route('admin.servers.swap', ['server' => $server->getSlug(), 'up' => 1]) }}" data-toggle="tooltip" data-placement="top" title="Przesuń w górę">
                                <i class="fas fa-arrow-up fa-fw"></i>
                            </a>
                        @endif

                        @if (!(($servers->currentPage() == $servers->lastPage()) && ($server->getId() == $servers->last()->getId())))
                            <a class="btn btn-table" href="{{ route('admin.servers.swap', ['server' => $server->getSlug(), 'up' => 0]) }}" data-toggle="tooltip" data-placement="top" title="Przesuń w dół">
                                <i class="fas fa-arrow-down fa-fw"></i>
                            </a>
                        @endif
                    </td>
                    <td>
                        <div class="form-check form-switch">
                            <input class="form-check-input switch-input-redirect" type="checkbox" id="{{ 'server' . $server->getId() . 'ActiveSwitch' }}" data-switch-target="{{ route('admin.servers.active.toggle', $server->getSlug()) }}" {{ $server->isActive() ? 'checked' : '' }}>
                            <label class="form-check-label" for="{{ 'server' . $server->getId() . 'ActiveSwitch' }}"></label>
                        </div>
                    </td>
                    <td>
                        <a class="btn btn-table" href="{{ route('admin.servers.announcement.show', $server->getSlug()) }}" data-toggle="tooltip" data-placement="top" title="Zarządzaj ogłoszeniem">
                            <i class="fas fa-bullhorn fa-fw"></i>
                        </a>
                        <a class="btn btn-table" href="{{ route('admin.servers.edit', $server->getSlug()) }}" data-toggle="tooltip" data-placement="top" title="Edytuj">
                            <i class="fas fa-edit fa-fw"></i>
                        </a>
                        <button class="btn btn-table entity-delete-btn" data-entity-name="{{ $server->getName() . ' (ID: #' . $server->getId() . ')' }}" data-target="{{ route('admin.servers.delete', $server->getSlug()) }}" data-toggle="tooltip" data-placement="top" title="Usuń">
                            <i class="fas fa-times fa-fw"></i>
                        </button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    {{ $servers->links() }}
@endsection

@section('modals')
    @include('admin.components.entity_delete_confirmation_modal')
@endsection
