@extends('admin.components.layout')

@section('title', 'Użytkownicy ACP')

@section('acp-card-title')
    <h1>
        <i class="fas fa-users"></i> Użytkownicy ACP
    </h1>
@endsection

@section('content')
    <table class="table table-hover table-centered table-responsive-lg">
        <thead>
        <tr>
            <th scope="col">ID</th>
            <th scope="col">Avatar</th>
            <th scope="col">Nazwa użytkownika</th>
            <th scope="col">Ostatnie logowanie</th>
            <th scope="col"></th>
        </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
                <tr>
                    <th scope="row">#{{ $user->getId() }}</th>
                    <td>
                        <img class="avatar avatar-lg" src="{{ $user->getAvatarUrl() }}" alt="{{ $user->getName() . '\'s avatar' }}">
                    </td>
                    <td>{{ $user->getName() }}</td>
                    <td>
                        @if ($user->getLastLoginAttemptAt() === null)
                            Brak informacji
                        @else
                            <span class="badge {{ $user->isLastLoginAttemptSuccessful() ? 'bg-success' : 'bg-danger' }}">
                                {{ ($user->isLastLoginAttemptSuccessful() ? 'Udane' : 'Nieudane') . ', ' . $user->getLastLoginAttemptAt()->diffForHumans() . ' z adresu ' . $user->getLastLoginAttemptIp()  }}
                            </span>
                        @endif
                    </td>
                    <td>
                        @if ($user->getId() !== Auth::user()->getId())
                            <a class="btn btn-table" href="{{ route('admin.users.changePassword', $user->getId()) }}" data-toggle="tooltip" data-placement="top" title="Zresetuj hasło"><i class="fas fa-key fa-fw"></i></a>
                            <a class="btn btn-table" href="{{ route('admin.users.edit', $user->getId()) }}" data-toggle="tooltip" data-placement="top" title="Edytuj"><i class="fas fa-edit fa-fw"></i></a>
                            <a class="btn btn-table" href="{{ route('admin.users.delete', $user->getId()) }}" data-toggle="tooltip" data-placement="top" title="Usuń"><i class="fas fa-times fa-fw"></i></a>
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    {{ $users->links() }}
@endsection
