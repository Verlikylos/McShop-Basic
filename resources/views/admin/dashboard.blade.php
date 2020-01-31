@extends('admin.components.layout')

@section('title', 'Dashboard')

@section('acp-card-title')
    <h4 class="acp-card-title">
        <i class="fas fa-desktop"></i> Pulpit
    </h4>
@endsection

@section('content')
    <div class="row">
        <div class="col-12 col-md-7">
            <div class="card bg-white border-primary shadow-sm">
                <div class="card-header text-white bg-primary">
                    <i class="fas fa-chart-line"></i> Sprzedaż usług w miesiącu Listopad 2019
                </div>
                <div class="card-body">
                    ...
                </div>
            </div>
        </div>
        <div class="col-12 col-md-5">
            <div class="card bg-white border-primary shadow-sm">
                <div class="card-header text-white bg-primary">
                    <i class="fas fa-chart-bar"></i> Sprzedaż usług w roku 2019
                </div>
                <div class="card-body">
                    ...
                </div>
            </div>
        </div>
    </div>
    <div class="row mt-3">
        <div class="col-12 col-md-6 col-lg-6">
            <div class="card bg-white border-primary shadow-sm">
                <div class="card-header text-white bg-primary">
                    <i class="fas fa-server"></i> Status serwerów
                </div>
                <div class="card-body">
                    <table id="acpServerStatusesTable" class="table table-responsive-lg">
                        <tbody>
                        <tr>
                            <td>Serwer Hardcore</td>
                            <td>
                                <span class="badge badge-success">Online</span>
                            </td>
                            <td class="text-right">
                                <span class="badge badge-info">25/100</span>
                            </td>
                        </tr>
                        <tr>
                            <td>Serwer Survival</td>
                            <td>
                                <span class="badge badge-success">Online</span>
                            </td>
                            <td class="text-right">
                                <span class="badge badge-info">25/100</span>
                            </td>
                        </tr>
                        <tr>
                            <td>Serwer MiniGames</td>
                            <td>
                                <span class="badge badge-danger">Offline</span>
                            </td>
                            <td class="text-right">
                                <span class="badge badge-info">0/0</span>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-6 col-lg-4">
            <div class="card bg-white border-primary shadow-sm">
                <div class="card-header text-white bg-primary">
                    Informacje o skrypcie
                </div>
                <div class="card-body">
                    ...
                </div>
            </div>
        </div>
    </div>
@endsection
