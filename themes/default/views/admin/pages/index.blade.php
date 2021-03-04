@extends('admin.components.layout')

@section('title', 'Własne strony')

@section('acp-card-title')
    <h1>
        <i class="fas fa-file-code"></i> Własne strony
    </h1>
@endsection

@section('content')
    <table class="table table-hover table-centered table-responsive-lg">
        <thead>
        <tr>
            <th scope="col">ID</th>
            <th scope="col">Nazwa</th>
            <th scope="col">Typ</th>
            <th scope="col">Podgląd</th>
            <th scope="col">Kolejność</th>
            <th scope="col">Aktywna</th>
            <th scope="col"></th>
        </tr>
        </thead>
        <tbody>
            @foreach ($pages as $page)
                <tr>
                    <th scope="row">#{{ $page->getId() }}</th>
                    <td>
                        {!! $page->getIcon() != null ? '<i class="' . $page->getIcon() . ' mr-1"></i>' : '' !!}
                        {{ $page->getName() }}
                    </td>
                    <td>
                        {!! $page->getType() == 'LINK' ? '<span class="badge bg-info">Odnośnik</span>' : '<span class="badge bg-success">Strona</span>' !!}
                    </td>
                    <td>
                        @if ($page->getType() == 'LINK')
                            <a class="btn btn-table" href="{{ $page->getContent() }}" data-toggle="tooltip" data-placement="top" data-title="Podgląd" target="_blank">
                                <i class="fas fa-eye"></i>
                            </a>
                        @else
                            <a class="btn btn-table" href="{{ route('page', $page->getSlug()) }}" data-toggle="tooltip" data-placement="top" data-title="Podgląd" target="_blank">
                                <i class="fas fa-eye"></i>
                            </a>
                        @endif
                    </td>
                    <td>
                        @if (!(($pages->currentPage() == 1) && ($page->getId() == $pages->first()->getId())))
                            <a class="btn btn-table" href="{{ route('admin.pages.swap', ['page' => $page->getSlug(), 'up' => 1]) }}" data-toggle="tooltip" data-placement="top" title="Przesuń w górę">
                                <i class="fas fa-arrow-up fa-fw"></i>
                            </a>
                        @endif

                        @if (!(($pages->currentPage() == $pages->lastPage()) && ($page->getId() == $pages->last()->getId())))
                            <a class="btn btn-table" href="{{ route('admin.pages.swap', ['page' => $page->getSlug(), 'up' => 0]) }}" data-toggle="tooltip" data-placement="top" title="Przesuń w dół">
                                <i class="fas fa-arrow-down fa-fw"></i>
                            </a>
                        @endif
                    </td>
                    <td>
                        <div class="form-check form-switch">
                            <input class="form-check-input switch-input-redirect" type="checkbox" id="{{ 'page' . $page->getId() . 'ActiveSwitch' }}" data-switch-target="{{ route('admin.pages.active.toggle', $page->getSlug()) }}" {{ $page->isActive() ? 'checked' : '' }}>
                            <label class="form-check-label" for="{{ 'page' . $page->getId() . 'ActiveSwitch' }}"></label>
                        </div>
                    </td>
                    <td>
                        <a class="btn btn-table" href="{{ route('admin.pages.edit', $page->getSlug()) }}" data-toggle="tooltip" data-placement="top" title="Edytuj">
                            <i class="fas fa-edit fa-fw"></i>
                        </a>
                        <a class="btn btn-table" href="{{ route('admin.pages.delete', $page->getSlug()) }}" data-toggle="tooltip" data-placement="top" title="Usuń">
                            <i class="fas fa-times fa-fw"></i>
                        </a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    {{ $pages->links() }}
@endsection
