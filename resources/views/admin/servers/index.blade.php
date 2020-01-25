@extends('admin.components.layout')

@section('acp-card-title')
    <h4 class="acp-card-title">
        <i class="fas fa-server"></i> Serwery
    </h4>
    <a href="{{ route('admin.servers.create') }}" class="btn btn-primary"><i class="fas fa-plus"></i> Dodaj serwer</a>
@endsection

@section('content')
    <section class="paginated-table-wrapper">
        <table id="serversTable" class="table table-striped table-centered table-responsive-lg">
            <thead class="thead-dark">
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
                        <td>{!! $server->getConnectionMethod() == 'api' ? '<span class="badge badge-success">API</span>' : '<span class="badge badge-warning">RCON</span>' !!}</td>
                        <td class="td-actions">
                            @if (!(($servers->currentPage() == 1) && ($server->getId() == $servers->first()->getId())))
                                <a class="btn btn-primary" href="{{ route('admin.servers.swap', ['server' => $server->getId(), 'up' => 1]) }}" data-toggle="tooltip" data-placement="top" title="Przesuń w górę">
                                    <i class="fas fa-chevron-up fa-fw"></i>
                                </a>
                            @endif

                            @if (!(($servers->currentPage() == $servers->lastPage()) && ($server->getId() == $servers->last()->getId())))
                                <a class="btn btn-primary" href="{{ route('admin.servers.swap', ['server' => $server->getId(), 'up' => 0]) }}" data-toggle="tooltip" data-placement="top" title="Przesuń w dół">
                                    <i class="fas fa-chevron-down fa-fw"></i>
                                </a>
                            @endif
                        </td>
                        <td>
                            <div class="custom-control custom-switch">
                                <input type="checkbox" class="custom-control-input serverActiveStatusSwitch" id="{{ 'server' . $server->getId() . 'ActiveSwitch' }}" data-target="{{ route('admin.servers.active.toggle', $server->getId()) }}" {{ $server->isActive() ? 'checked' : '' }}>
                                <label class="custom-control-label" for="{{ 'server' . $server->getId() . 'ActiveSwitch' }}"></label>
                            </div>
                        </td>
                        <td class="td-actions">
                            <a class="btn btn-primary" href="{{ route('admin.servers.announcement.show', $server->getId()) }}" data-toggle="tooltip" data-placement="top" title="Zarządzaj ogłoszeniem">
                                <i class="fas fa-bullhorn fa-fw"></i>
                            </a>
                            <a class="btn btn-info" href="{{ route('admin.servers.edit', $server->getId()) }}" data-toggle="tooltip" data-placement="top" title="Edytuj">
                                <i class="fas fa-edit fa-fw"></i>
                            </a>
                            <button class="btn btn-danger entity-delete-btn" data-entity-name="{{ $server->getName() . ' (ID: #' . $server->getId() . ')' }}" data-target="{{ route('admin.servers.delete', $server->getId()) }}" data-toggle="tooltip" data-placement="top" title="Usuń">
                                <i class="fas fa-times fa-fw"></i>
                            </button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </section>

    {{ $servers->links() }}
@endsection

@section('modals')
    @include('admin.components.entity_delete_confirmation_modal')
@endsection
