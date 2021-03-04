@extends('admin.components.layout')

@section('title', 'Logi')

@section('acp-card-title')
    <h4 class="acp-card-title">
        <i class="fas fa-database"></i> Logi
    </h4>
@endsection

@section('content')
    <ul class="nav nav-pills nav-fill mb-3">
        <li class="nav-item">
            <a class="nav-link active" href="#">
                <i class="fas fa-database"></i>
                Logi ACP
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#">
                <i class="fas fa-credit-card"></i>
                Logi płatności
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#">
                <i class="fas fa-terminal"></i>
                Kolejka komend
            </a>
        </li>
    </ul>
    <section class="paginated-table-wrapper">
        <table id="pagesTable" class="table table-striped table-centered table-responsive-lg">
            <thead class="thead-dark">
            <tr>
                <th scope="col">Kategoria</th>
                <th scope="col">Szczegóły</th>
                <th scope="col">Użytkownik</th>
                <th scope="col">Data</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($logs as $log)
                <tr>
                    <td><span class="badge badge-{{ $log->getColor() }}">{{ __('admin.logs.categories.' . $log->getCategory()) }}</span></td>
                    <td>{!! $log->getDetails() !!}</td>
                    <td>{{ $log->getUser() != null && $log->getUser()->exists ? $log->getUser()->getName() . ' (ID: #' . $log->getUser()->getId() . ')' : 'Brak danych' }}</td>
                    <td>{{ $log->getDate()->diffForHumans() }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </section>
    
    {{ $logs->links() }}
@endsection
