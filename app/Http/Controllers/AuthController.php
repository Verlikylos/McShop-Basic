<?php

namespace App\Http\Controllers;

use App\Http\Requests\AuthLoginRequest;
use App\Models\User;
use Composer\Config;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\View;
use Symfony\Component\Console\Input\Input;

class AuthController extends Controller
{
    public function index()
    {
        if (Auth::user()) {
            return Redirect::route('admin.dashboard');
        }

        return View::make('login');
    }

    public function login(AuthLoginRequest $request) {

        if (Auth::user()) {
            return Redirect::route('admin.dashboard');
        }

        $credentials = [
          'name' => $request->input('authUsername'),
          'password' => $request->input('authPassword')
        ];

        $clientIp = $request->ip();

        if ($request->header('CF-Connecting-IP') !== null) {
            $clientIp = $request->header('CF-Connecting-IP');
        }

        if (!Auth::attempt($credentials, $request->filled('authRemember'))) {

            $user = null;

            try {
                $user = User::where('name', $credentials['name'])->firstOrFail();
            } catch (ModelNotFoundException $e) {
                $user = null;
            }

            if ($user !== null) {
                $user->setLastLoginInfo($clientIp, false);
                $user->save();
            }

            return Redirect::back()->withInput(['authUsername' => $credentials['name']])->withErrors(['main' => 'Podane dane logowania są niepoprawne!']);
        }

        $user = Auth::user();
        $user->setLastLoginInfo($clientIp, true);
        $user->save();

        return Redirect::route('admin.dashboard');
    }
}
