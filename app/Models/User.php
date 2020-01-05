<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    use Authenticatable;

    public $timestamps = false;

    public $casts = [
        'permissions' => 'object'
    ];

    public $dates = [
        'last_login_attempt_at'
    ];

    public static function create($name, $password, $permissions) {
        $user = new User();

        $user->name = $name;
        $user->password = bcrypt($password);
        $user->avatar_url = asset('images/default-avatar.png');

        if (is_array($permissions)) {
            $permissions = (object) $permissions;
        }

        $user->permissions = $permissions;
        $user->save();

        // TODO log to db
    }

    public function updatePermissions($permissions)
    {

        if (is_array($permissions)) {
            $permissions = (object) $permissions;
        }

        $this->permissions = $permissions;
        $this->save();

        // TODO log to db
    }

    public static function remove($id) {
        $user = User::findOrFail($id);


        $user->delete();

        // TODO log to db
    }

    public static function changePassword($id, $password) {
        $user = User::findOrFail($id);

        $user->password = bcrypt($password);
        $user->save();

        // TODO log to db
    }
}
