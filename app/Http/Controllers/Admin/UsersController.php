<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\User;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\View;

class UsersController extends Controller
{
    public function index()
    {
        $users = User::all();
        
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
        
        $name = $request->input('userName');
        $password = str_random(16);
        
        User::create($name, $password, $permissions);
        
        return Redirect::route('admin.users.index')
            ->with('sessionMessage', ['type' => 'success', 'content' =>
                'Pomyślnie utworzono nowego użytkownika! Dane do logowania:<br><br>' .
                'Login: <span class="font-weight-bold">' . $name . '</span><br>' .
                'Hasło: <span class="font-weight-bold">' . $password . '</span>']);
    }
    
    public function changePassword($id)
    {
        $user = null;
        
        try {
            $user = User::findOrFail($id);
        } catch (ModelNotFoundException $e) {
            return Redirect::route('admin.users.index')->with('sessionMessage', ['type' => 'danger', 'content' => 'Użytkownik o ID #' . $id . ' nie istnieje!']);
        }
        
        if ($id === Auth::user()->getAuthIdentifier()) {
            return Redirect::route('admin.users.index')->with('sessionMessage', ['type' => 'danger', 'content' => 'Nie możesz zmienić hasła tego użytkownika!']);
        }
    
        $password = str_random(16);
    
        User::changePassword($id, $password);
        
        return Redirect::route('admin.users.index')
            ->with('sessionMessage', ['type' => 'success', 'content' =>
                'Pomyślnie dokonano zmiany hasła dla użytkownika <span class="font-weight-bold">' . $user->getName() . ' (ID: #' . $id . ')</span>! Nowe hasło: <span class="font-weight-bold">' . $password . '</span>']);
    }
    
    public function edit($id)
    {
        $user = null;
    
        try {
            $user = User::findOrFail($id);
        } catch (ModelNotFoundException $e) {
            return Redirect::route('admin.users.index')->with('sessionMessage', ['type' => 'danger', 'content' => 'Użytkownik o ID #' . $id . ' nie istnieje!']);
        }
    
        if ($id === Auth::user()->getAuthIdentifier()) {
            return Redirect::route('admin.users.index')->with('sessionMessage', ['type' => 'danger', 'content' => 'Nie możesz edytować tego użytkownika!']);
        }
        
        return View::make('admin.users.edit', ['user' => $user]);
    }
    
    public function update(UpdateUserRequest $request, $id)
    {
        $user = null;
    
        try {
            $user = User::findOrFail($id);
        } catch (ModelNotFoundException $e) {
            return Redirect::route('admin.users.index')->with('sessionMessage', ['type' => 'danger', 'content' => 'Użytkownik o ID #' . $id . ' nie istnieje!']);
        }
    
        if ($id === Auth::user()->getAuthIdentifier()) {
            return Redirect::route('admin.users.index')->with('sessionMessage', ['type' => 'danger', 'content' => 'Nie możesz edytować tego użytkownika!']);
        }
    
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
        
        $user->updatePermissions($permissions);
    
        return Redirect::route('admin.users.index')
            ->with('sessionMessage', ['type' => 'success', 'content' =>
                'Pomyślnie zaktualizowano użytkownika <span class="font-weight-bold">' . $user->getName() . ' (ID: #' . $id . ')</span>!']);
    }
    
    public function delete($id)
    {
        $user = null;
        
        try {
            $user = User::findOrFail($id);
        } catch (ModelNotFoundException $e) {
            return Redirect::route('admin.users.index')->with('sessionMessage', ['type' => 'danger', 'content' => 'Użytkownik o ID #' . $id . ' nie istnieje!']);
        }
    
        if ($id === Auth::user()->getAuthIdentifier()) {
            return Redirect::route('admin.users.index')->with('sessionMessage', ['type' => 'danger', 'content' => 'Nie możesz usunąć tego użytkownika!']);
        }
    
        User::remove($id);
        
        return Redirect::route('admin.users.index')
            ->with('sessionMessage', ['type' => 'success', 'content' =>
                'Pomyślnie usunięto użytkownika <span class="font-weight-bold">' . $user->getName() . ' (ID: #' . $id . ')</span>!']);
    }
}
