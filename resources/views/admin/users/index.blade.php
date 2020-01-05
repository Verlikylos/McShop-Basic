@extends('admin.components.layout')

@section('acp-card-title')
    <h4 class="acp-card-title">
        <i class="fas fa-users"></i> Użytkownicy ACP
    </h4>
    <a href="{{ route('admin.users.create') }}" class="btn btn-primary"><i class="fas fa-plus"></i> Dodaj użytkownika</a>
@endsection

@section('content')
    <section class="paginated-table-wrapper">
        <table id="usersTable" class="table table-striped table-centered table-responsive-lg table-paginated">
            <thead class="thead-dark">
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
                            <img class="user-avatar" src="{{ $user->getAvatarUrl() }}" alt="{{ $user->getName() . '\'s avatar' }}">
                        </td>
                        <td>{{ $user->getName() }}</td>
                        <td>
                            @if ($user->getLastLoginAttemptAt() === null)
                                Brak informacji
                            @else
                                <span class="badge {{ $user->isLastLoginAttemptSuccessful() ? 'badge-success' : 'badge-danger' }}">
                                    {{ ($user->isLastLoginAttemptSuccessful() ? 'Udane' : 'Nieudane') . ', ' . $user->getLastLoginAttemptAt()->diffForHumans() . ' z adresu ' . $user->getLastLoginAttemptIp()  }}
                                </span>
                            @endif
                        </td>
                        <td class="td-actions">
                            @if ($user->getId() !== Auth::user()->getId())
                                <a class="btn btn-primary" href="{{ route('admin.users.changePassword', $user->getId()) }}" data-toggle="tooltip" data-placement="top" title="Zresetuj hasło"><i class="fas fa-key fa-fw"></i></a>
                                <a class="btn btn-info" href="{{ route('admin.users.edit', $user->getId()) }}" data-toggle="tooltip" data-placement="top" title="Edytuj"><i class="fas fa-edit fa-fw"></i></a>
                                <a class="btn btn-danger" href="{{ route('admin.users.delete', $user->getId()) }}" data-toggle="tooltip" data-placement="top" title="Usuń"><i class="fas fa-times fa-fw"></i></a>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </section>

    {!! $users->links() !!}
@endsection
