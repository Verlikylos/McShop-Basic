@extends('admin.components.layout')

@section('title', 'Własne strony')

@section('acp-card-title')
    <h4 class="acp-card-title">
        <i class="fas fa-file-code"></i> Własne strony
    </h4>
    <a href="{{ route('admin.pages.create') }}" class="btn btn-outline-primary"><i class="fas fa-plus"></i> Dodaj stronę</a>
@endsection

@section('content')
    <section class="paginated-table-wrapper">
        <table id="pagesTable" class="table table-striped table-centered table-responsive-lg">
            <thead class="thead-dark">
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
                            {!! $page->getType() == 'LINK' ? '<span class="badge badge-info">Odnośnik</span>' : '<span class="badge badge-success">Strona</span>' !!}
                        </td>
                        <td>
                            @if ($page->getType() == 'LINK')
                                <a class="btn btn-sm btn-info" href="{{ $page->getContent() }}">
                                    <i class="fas fa-chevron-right"></i>
                                    Przejdź
                                </a>
                            @else
                                <a class="btn btn-sm btn-info" href="{{ route('page', $page->getSlug()) }}">
                                    <i class="fas fa-chevron-right"></i>
                                    Przejdź
                                </a>
                            @endif
                        </td>
                        <td class="td-actions">
                            @if (!(($pages->currentPage() == 1) && ($page->getId() == $pages->first()->getId())))
                                <a class="btn btn-primary" href="{{ route('admin.pages.swap', ['page' => $page->getSlug(), 'up' => 1]) }}" data-toggle="tooltip" data-placement="top" title="Przesuń w górę">
                                    <i class="fas fa-chevron-up fa-fw"></i>
                                </a>
                            @endif
                            
                            @if (!(($pages->currentPage() == $pages->lastPage()) && ($page->getId() == $pages->last()->getId())))
                                <a class="btn btn-primary" href="{{ route('admin.pages.swap', ['page' => $page->getSlug(), 'up' => 0]) }}" data-toggle="tooltip" data-placement="top" title="Przesuń w dół">
                                    <i class="fas fa-chevron-down fa-fw"></i>
                                </a>
                            @endif
                        </td>
                        <td>
                            <div class="custom-control custom-switch">
                                <input type="checkbox" class="custom-control-input entityActiveStatusSwitch" id="{{ 'page' . $page->getId() . 'ActiveSwitch' }}" data-target="{{ route('admin.pages.active.toggle', $page->getSlug()) }}" {{ $page->isActive() ? 'checked' : '' }}>
                                <label class="custom-control-label" for="{{ 'page' . $page->getId() . 'ActiveSwitch' }}"></label>
                            </div>
                        </td>
                        <td class="td-actions">
                            <a class="btn btn-info" href="{{ route('admin.pages.edit', $page->getSlug()) }}" data-toggle="tooltip" data-placement="top" title="Edytuj">
                                <i class="fas fa-edit fa-fw"></i>
                            </a>
                            <a class="btn btn-danger" href="{{ route('admin.pages.delete', $page->getSlug()) }}" data-toggle="tooltip" data-placement="top" title="Usuń">
                                <i class="fas fa-times fa-fw"></i>
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </section>
    
    {{ $pages->links() }}
@endsection
