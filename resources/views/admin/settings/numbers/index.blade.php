@extends('admin.components.layout')

@section('acp-card-title')
    <div class="d-flex flex-row w-75">
        <h4 class="acp-card-title">
            <i class="fas fa-sms"></i> Ustawienia numerów SMS
        </h4>
        <select data-target="{{ route('admin.settings.numbers.index') }}" class="custom-select custom-select-sm entityActiveFilterSelect w-25 ml-2">
            @foreach(config('mcshop.sms_operators') as $key => $value)
                <option value="{{ $key }}" {{ $activeOperator == $key ? 'selected' : '' }}>{{ 'Operator SMS: ' . $value }}</option>
            @endforeach
        </select>
    </div>
    <a href="{{ route('admin.settings.numbers.create') }}" class="btn btn-primary"><i class="fas fa-plus"></i> Dodaj numer</a>
@endsection

@section('content')
    <section class="paginated-table-wrapper">
        <table id="numbersTable" class="table table-striped table-centered table-responsive-lg">
            <thead class="thead-dark">
                <tr>
                    <th scope="col">Numer</th>
                    <th scope="col">Koszt netto</th>
                    <th scope="col">Koszt brutto</th>
                    <th scope="col"></th>
                </tr>
            </thead>
            <tbody>
                @foreach($numbers as $number)
                    <tr>
                        <td>{{ $number->getNumber() }}</td>
                        <td>{{ $number->getNettoCostFormatted() }}</td>
                        <td>{{ $number->getBruttoCostFormatted() }}</td>
                        <td class="td-actions">
                            <a class="btn btn-danger" href="{{ route('admin.settings.numbers.delete', $number->getSlug()) }}" data-toggle="tooltip" data-placement="top" title="Usuń"><i class="fas fa-times fa-fw"></i></a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </section>

    {{ $numbers->links() }}
@endsection
