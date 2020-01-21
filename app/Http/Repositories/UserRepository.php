<?php


namespace App\Http\Repositories;


use App\Http\Repositories\Interfaces\UserRepositoryInterface;
use App\Models\User;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class UserRepository implements UserRepositoryInterface
{
    private $table = 'users';

    public function all(): Collection
    {
        return User::all();
    }

    public function getById(int $id): User
    {
        return User::findOrFail($id);
    }

    public function new(array $data): User
    {
        if (!isset($data['avatar_url'])) {
            $data['avatar_url'] = asset('images/default-avatar.png');
        }

        $user = new User($data);
        $user->save();

        return $user;
    }

    public function update(int $userId, array $data): int
    {
        return DB::table($this->table)->where('id', $userId)->update($data);
    }

    public function delete(int $userId): int
    {
        return DB::table($this->table)->where('id', $userId)->delete();
    }
}
