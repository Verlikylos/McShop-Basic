@extends('admin.components.layout', ['withEditorStyles' => true])

@section('acp-card-title')
    <h4 class="acp-card-title">
        <i class="fas fa-bullhorn"></i> Ogłoszenie serwera <span class="font-weight-bold">{{ $server->getName() }} (ID: #{{ $server->getId() }})</span>
    </h4>
    <a href="{{ route('admin.servers.index') }}" class="btn btn-outline-secondary"><i class="fas fa-times"></i> Anuluj</a>
@endsection

@section('content')
    <form id="serverAnnouncementForm" method="POST" action="{{ route('admin.servers.announcement.update', $server->getId()) }}">
        @csrf
        @method('PATCH')

        <div class="row">
            <div class="col-12 mx-auto">
                <div id="serverAnnouncementEditor"></div>
                <input type="hidden" id="serverAnnouncementContent" name="serverAnnouncementContent" value="{{ $server->getAnnouncementContent() }}">
            </div>
            <div class="col-12 text-center">
                <div class="custom-control custom-switch mt-3">
                    <input type="checkbox" class="custom-control-input" id="serverAnnouncementEnabled" name="serverAnnouncementEnabled" {{ $server->isAnnouncementEnabled() ? 'checked' : '' }}>
                    <label class="custom-control-label" for="serverAnnouncementEnabled">{!! $server->isAnnouncementEnabled() ? 'Ogłoszenie aktywne&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;' : 'Ogłoszenie nieaktywne' !!}</label>
                </div>

                <button type="submit" class="btn btn-success my-5"><i class="fas fa-check"></i> Zapisz zmiany</button>
            </div>
        </div>
    </form>
@endsection
