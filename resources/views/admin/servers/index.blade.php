@extends('admin.components.layout')

@section('acp-card-title')
    <h4 class="acp-card-title">
        <i class="fas fa-server"></i> Serwery
    </h4>
    <a href="" class="btn btn-primary"><i class="fas fa-plus"></i> Dodaj serwer</a>
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
                    <th scope="col">Aktywny</th>
                    <th scope="col"></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($servers as $server)
                    <tr>
                        <th scope="row">#{{ $server->getId() }}</th>
                        <td>{{ $server->getName() }}</td>
                        <td>{{ $server->getDisplayAddress() }}</td>
                        <td>{!! $server->getConnectionMethod() == 'api' ? '<span class="badge badge-success">API</span>' : '<span class="badge badge-warning">RCON</span>' !!}</td>
                        <td>
                            <div class="custom-control custom-switch">
                                <input type="checkbox" class="custom-control-input" id="customSwitch1" {{ $server->isActive() ? 'checked' : '' }}>
                                <label class="custom-control-label" for="customSwitch1"></label>
                            </div>
                        </td>
                        <td class="td-actions">
                            <a class="btn btn-primary" href="" data-toggle="tooltip" data-placement="top" title="Zarządzaj ogłoszeniem"><i class="fas fa-bullhorn fa-fw"></i></a>
                            <a class="btn btn-info" href="" data-toggle="tooltip" data-placement="top" title="Edytuj"><i class="fas fa-edit fa-fw"></i></a>
                            <a class="btn btn-danger" href="" data-toggle="tooltip" data-placement="top" title="Usuń"><i class="fas fa-times fa-fw"></i></a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </section>

    {{ $servers->links() }}
@endsection
