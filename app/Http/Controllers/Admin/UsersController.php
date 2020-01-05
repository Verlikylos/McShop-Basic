<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Repositories\Interfaces\UserRepositoryInterface;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Str;

class UsersController extends Controller
{

    /**
     * @var UserRepositoryInterface
     */
    private $userRepository;

    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
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

        $permissions = [
          'users' => $request->has('permissionUsers'),
          'servers' => $request->has('permissionServers'),
          'services' => $request->has('permissionServices'),
          'vouchers' => $request->has('permissionVouchers'),
          'pages' => $request->has('permissionPages'),
          'purchases' => $request->has('permissionPurchases'),
          'logs' => $request->has('permissionLogs'),
          'settings' => $request->has('permissionSettings'),
        ];

        $password = Str::random(16);

        $data = [
            'name' => $request->get('userName'),
            'password' => bcrypt($password),
            'permissions' => $permissions
        ];

        $user = $this->userRepository->new($data);

        return Redirect::route('admin.users.index')
            ->with('sessionMessage', ['type' => 'success', 'content' =>
                'Pomyślnie utworzono nowego użytkownika! Dane do logowania:<br><br>' .
                'Login: <span class="font-weight-bold">' . $user->getName() . '</span><br>' .
                'Hasło: <span class="font-weight-bold">' . $password . '</span>']);
    }

    public function changePassword(User $user)
    {
        if ($user->getId() === Auth::user()->getId()) {
            return Redirect::route('admin.users.index')->with('sessionMessage', ['type' => 'danger', 'content' => 'Nie możesz zmienić hasła tego użytkownika!']);
        }

        $password = Str::random(16);

        $user->setPassword($password);
        $user->save();

        return Redirect::route('admin.users.index')
            ->with('sessionMessage', ['type' => 'success', 'content' =>
                'Pomyślnie dokonano zmiany hasła dla użytkownika <span class="font-weight-bold">' . $user->getName() . ' (ID: #' . $user->getId() . ')</span>! ' .
                'Nowe hasło: <span class="font-weight-bold">' . $password . '</span>']);
    }

    public function edit(User $user)
    {
        if ($user->getId() === Auth::user()->getId()) {
            return Redirect::route('admin.users.index')->with('sessionMessage', ['type' => 'danger', 'content' => 'Nie możesz edytować tego użytkownika!']);
        }

        return View::make('admin.users.edit', ['user' => $user]);
    }

    public function update(UpdateUserRequest $request, User $user)
    {
        if ($user->getId() === Auth::user()->getId()) {
            return Redirect::route('admin.users.index')->with('sessionMessage', ['type' => 'danger', 'content' => 'Nie możesz edytować tego użytkownika!']);
        }

        $permissions = (object) [
            'users' => $request->has('permissionUsers'),
            'servers' => $request->has('permissionServers'),
            'services' => $request->has('permissionServices'),
            'vouchers' => $request->has('permissionVouchers'),
            'pages' => $request->has('permissionPages'),
            'purchases' => $request->has('permissionPurchases'),
            'logs' => $request->has('permissionLogs'),
            'settings' => $request->has('permissionSettings'),
        ];

        $user->setPermissions($permissions);
        $user->save();

        return Redirect::route('admin.users.index')
            ->with('sessionMessage', ['type' => 'success', 'content' =>
                'Pomyślnie zaktualizowano użytkownika <span class="font-weight-bold">' . $user->getName() . ' (ID: #' . $user->getId() . ')</span>!']);
    }

    public function delete(User $user)
    {


        if ($user->getId() === Auth::user()->getId()) {
            return Redirect::route('admin.users.index')->with('sessionMessage', ['type' => 'danger', 'content' => 'Nie możesz usunąć tego użytkownika!']);
        }

        $this->userRepository->delete($user->getId());

        return Redirect::route('admin.users.index')
            ->with('sessionMessage', ['type' => 'success', 'content' =>
                'Pomyślnie usunięto użytkownika <span class="font-weight-bold">' . $user->getName() . ' (ID: #' . $user->getId() . ')</span>!']);
    }
}
