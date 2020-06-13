<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Repositories\LogRepositoryInterface;
use App\Http\Repositories\UserRepositoryInterface;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Str;

class UsersController extends Controller
{
    private $userRepository;
    private $logRepository;
    
    public function __construct(UserRepositoryInterface $userRepository, LogRepositoryInterface $logRepository)
    {
        $this->userRepository = $userRepository;
        $this->logRepository = $logRepository;
    }

    public function index()
    {
        $users = User::paginate(10);

        return View::make('admin.users.index')->with(['users' => $users]);
    }

    public function create() {
        return View::make('admin.users.create');
    }

    public function store(StoreUserRequest $request)
    {
        $password = Str::random(16);

        $data = [
            'name' => $request->get('userName'),
            'password' => bcrypt($password),
            'permissions' => [
                'users' => $request->has('permissionUsers'),
                'servers' => $request->has('permissionServers'),
                'services' => $request->has('permissionServices'),
                'vouchers' => $request->has('permissionVouchers'),
                'pages' => $request->has('permissionPages'),
                'purchases' => $request->has('permissionPurchases'),
                'logs' => $request->has('permissionLogs'),
                'settings' => $request->has('permissionSettings'),
            ]
        ];

        $user = $this->userRepository->new($data);
        
        $this->logRepository->new([
            'category' => 'USERS',
            'color' => 'success',
            'details' => Lang::get('admin.users.logs.created', [
                'user' => $user->getName(),
                'user_id' => $user->getId()
            ])
        ]);

        return Redirect::route('admin.users.index')
            ->with('sessionMessage', [
                'type' => 'success',
                'content' => Lang::get('admin.users.created', [
                    'login' => $user->getName(),
                    'password' => $password
                ])
            ]);
    }

    public function changePassword(User $user)
    {
        if ($user->getId() === Auth::user()->getId()) {
            return Redirect::back()
                ->with('sessionMessage', [
                    'type' => 'danger',
                    'content' => Lang::get('admin.users.cant_reset_password')
                ]);
        }

        $password = Str::random(16);

        $user->setPassword($password);
        $user->save();
    
        $this->logRepository->new([
            'category' => 'USERS',
            'color' => 'primary',
            'details' => Lang::get('admin.users.logs.password_reset', [
                'user' => $user->getName(),
                'user_id' => $user->getId()
            ])
        ]);

        return Redirect::back()
            ->with('sessionMessage', [
                'type' => 'success',
                'content' => Lang::get('admin.users.password_reset', [
                    'user' => $user->getName(),
                    'user_id' => $user->getId(),
                    'password' => $password
                ])
            ]);
    }

    public function edit(User $user)
    {
        if ($user->getId() === Auth::user()->getId()) {
            return Redirect::back()
                ->with('sessionMessage', [
                    'type' => 'danger',
                    'content' => Lang::get('admin.users.cant_edit')
                ]);
        }

        return View::make('admin.users.edit', ['user' => $user]);
    }

    public function update(UpdateUserRequest $request, User $user)
    {
        if ($user->getId() === Auth::user()->getId()) {
            return Redirect::route('admin.users.index')
                ->with('sessionMessage', [
                    'type' => 'danger',
                    'content' => Lang::get('admin.users.cant_edit')
                ]);
        }

        $data = [
            'permissions' => [
                'users' => $request->has('permissionUsers'),
                'servers' => $request->has('permissionServers'),
                'services' => $request->has('permissionServices'),
                'vouchers' => $request->has('permissionVouchers'),
                'pages' => $request->has('permissionPages'),
                'purchases' => $request->has('permissionPurchases'),
                'logs' => $request->has('permissionLogs'),
                'settings' => $request->has('permissionSettings'),
            ]
        ];

        $user->update($data);
        $user->save();
    
        $this->logRepository->new([
            'category' => 'USERS',
            'color' => 'info',
            'details' => Lang::get('admin.users.logs.updated', [
                'user' => $user->getName(),
                'user_id' => $user->getId()
            ])
        ]);

        return Redirect::route('admin.users.index')
            ->with('sessionMessage', [
                'type' => 'success',
                'content' => Lang::get('admin.users.updated', [
                    'user' => $user->getName(),
                    'user_id' => $user->getId()
                ])
            ]);
    }

    public function delete(User $user)
    {
        if ($user->getId() === Auth::user()->getId()) {
            return Redirect::back()
                ->with('sessionMessage', [
                    'type' => 'danger',
                    'content' => Lang::get('admin.users.cant_delete')
                ]);
        }

        $this->userRepository->delete($user->getId());
    
        $this->logRepository->new([
            'category' => 'USERS',
            'color' => 'danger',
            'details' => Lang::get('admin.users.logs.deleted', [
                'user' => $user->getName(),
                'user_id' => $user->getId()
            ])
        ]);

        return Redirect::route('admin.users.index')
            ->with('sessionMessage', [
                'type' => 'success',
                'content' => Lang::get('admin.users.deleted', [
                    'user' => $user->getName(),
                    'user_id' => $user->getId()
                ])
            ]);
    }
}
