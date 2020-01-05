<?php


namespace App\Http\Repositories;


use App\Http\Repositories\Interfaces\UserRepositoryInterface;
use App\Models\User;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Collection;

class UserRepository implements UserRepositoryInterface
{

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

    public function update(int $userId, array $data): bool
    {
        return User::findOrFail($userId)->update($data);
    }

    public function delete(int $userId): bool
    {
        return User::findOrFail($userId)->delete();
    }
}
