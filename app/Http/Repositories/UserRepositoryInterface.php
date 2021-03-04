<?php


namespace App\Http\Repositories;


use App\Models\User;
use Illuminate\Support\Collection;

interface UserRepositoryInterface
{
    public function all(): Collection;

    public function getById(int $id): User;

    public function new(array $data): User;

    public function update(int $userId, array $data): int;

    public function delete(int $userId): int;
}
