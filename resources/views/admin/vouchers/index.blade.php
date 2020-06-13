@extends('admin.components.layout')

@section('title', 'Użytkownicy ACP')

@section('acp-card-title')
    <h4 class="acp-card-title">
        <i class="fas fa-users"></i> Użytkownicy ACP
    </h4>
    <a href="{{ route('admin.vouchers.create') }}" class="btn btn-outline-primary"><i class="fas fa-cogs"></i> Generator voucherów</a>
@endsection

@section('content')
    <section class="paginated-table-wrapper">
        <table id="vouchersTable" class="table table-striped table-centered table-responsive-lg">
            <thead class="thead-dark">
            <tr>
                <th scope="col">Serwer</th>
                <th scope="col">Usługa</th>
                <th scope="col">Ilość użyć</th>
                <th scope="col">Wielorazowy <i class="fas fa-info-circle ml-1" data-toggle="tooltip" data-title="Czy dozwolone jest, aby gracz skorzystał z vouchera kilka razy, jeżeli pozwala on na wiele użyć."></i></th>
                <th scope="col">Status</th>
                <th scope="col"></th>
            </tr>
            </thead>
            <tbody>
            @foreach ($vouchers as $voucher)
                <tr>
                    <td>{{ $voucher->getService()->getServer()->getName() . ' (ID: #' . $voucher->getService()->getServer()->getId() . ')' }}</td>
                    <td>{{ $voucher->getService()->getName() . ' (ID: #' . $voucher->getService()->getId() . ')' }}</td>
                    <td>{{ $voucher->getUsagesAmount() }}</td>
                    <td>{{ $voucher->isManyUsagesPerPlayerAllowed() ? 'Tak' : 'Nie' }}</td>
                    <td>
                        @if (!empty($voucher->getUsedBy()))
                            <span data-toggle="tooltip" data-title="Wykorzystany przez: {{ $voucher->getUsedByString() }}">
                                {!! $voucher->getStatus() === 'ACTIVE' ? '<span class="badge badge-success">Aktywny <i class="fas fa-info-circle ml-1"></i></span>' : '<span class="badge badge-danger">Wykorzystany <i class="fas fa-info-circle ml-1"></i></span>' !!}
                            </span>
                        @else
                            {!! $voucher->getStatus() === 'ACTIVE' ? '<span class="badge badge-success">Aktywny</span>' : '<span class="badge badge-danger">Wykorzystany</span>' !!}
                        @endif
                    </td>
                    <td class="td-actions">
                        <button type="button" class="btn btn-info" data-toggle="modal" data-target="#voucher{{ $voucher->getId() }}Modal">
                            <i class="fas fa-eye"></i>
                        </button>
                        <a class="btn btn-danger" href="{{ route('admin.vouchers.delete', $voucher->getId()) }}">
                            <i class="fas fa-times"></i>
                        </a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </section>
    
    {{ $vouchers->links() }}
@endsection

@section('modals')
    @foreach ($vouchers as $voucher)
        <div class="modal fade" id="voucher{{ $voucher->getId() }}Modal" tabindex="-1" role="dialog" aria-labelledby="voucher{{ $voucher->getId() }}ModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="voucher{{ $voucher->getId() }}ModalLabel"><i class="fas fa-ticket-alt"></i> Kod vouchera</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group my-0">
                            <input type="text" class="form-control" value="{{ $voucher->getCode() }}" disabled>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
    
    @if (session('generatedVouchers'))
        <div class="modal fade" id="vouchersModal" tabindex="-1" role="dialog" aria-labelledby="vouchersModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="vouchersModalLabel"><i class="fas fa-check"></i> Sukces!</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p>{!! session('vouchersMessage') !!}</p>
                        @foreach (session('generatedVouchers') as $code)
                            <pre class="text-code"><code>{{ $code }}</code></pre>
                        @endforeach
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Zamknij</button>
                    </div>
                </div>
            </div>
        </div>
    @endif
@endsection

@section('scripts')
    @if (session('generatedVouchers'))
        <script>
            $('#vouchersModal').modal('show');
        </script>
    @endif
@endsection
