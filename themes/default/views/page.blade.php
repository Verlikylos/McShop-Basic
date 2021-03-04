@extends('components.layout')

@section('title', $page->getName())

@section('breadcrumb')
    <li class="breadcrumb-item active" aria-current="page">{{ $page->getName() }}</li>
@endsection

@section('content')
    <div class="card custom-page-card shadow">
        <div class="card-body">
            <h4>
                @if ($page->getIcon() != null)
                    <i class="{{ $page->getIcon() }}"></i>
                @endif
                {{ $page->getName() }}
            </h4>
            <hr>
            {!! $page->getFormattedContent() !!}
        </div>
    </div>
@endsection
