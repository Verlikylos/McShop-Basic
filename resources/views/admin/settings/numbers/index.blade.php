@extends('admin.components.layout')

@section('acp-card-title')
    <h4 class="acp-card-title">
        <i class="fas fa-cogs"></i> Ustawienia numerów SMS
    </h4>
    <select id="smsNumbersTableActiveOperator" data-target="{{ route('admin.settings.numbers.index') }}" class="custom-select custom-select-sm">
        @foreach(config('mcshop.sms_operators') as $operator)
            <option value="{{ $operator }}" {{ $activeOperator == $operator ? 'selected' : '' }}>{{ 'Operator SMS: ' . $operator }}</option>
        @endforeach
    </select>
    <a href="#" class="btn btn-primary"><i class="fas fa-plus"></i> Dodaj numer</a>
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
                        <td>{{ $number->getNettoCostFormated() }}</td>
                        <td>{{ $number->getBruttoCostFormated() }}</td>
                        <td class="td-actions">
                            <a class="btn btn-danger" href="#" data-toggle="tooltip" data-placement="top" title="Usuń"><i class="fas fa-times fa-fw"></i></a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </section>

    {{ $numbers->links() }}
@endsection
