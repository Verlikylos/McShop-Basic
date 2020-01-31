@extends('components.layout')

@section('title', 'Wybór serwera')

@section('breadcrumb')
    <li class="breadcrumb-item active" aria-current="page">Wybór serwera</li>
@endsection

@section('content')
    <div class="row">
        @foreach ($servers as $server)
            <div class="col-12 col-md-6 col-lg-4 col-xl-3">
                <div class="card shadow">
                    <img src="{{ $server->getImageUrl() }}" class="card-img-top" alt="{{ $server->getName() .'\'s image' }}">
                    <div class="card-body">
                        <h5 class="card-title text-center">{{ 'Serwer ' . $server->getName() }}</h5>
                        <a class="btn btn-primary btn-block" href="{{ route('home', $server->getSlug()) }}">Przejdź do sklepu serwera</a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection
