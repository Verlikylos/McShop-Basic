<?php


namespace App\Http\Repositories\Interfaces;


use App\Models\Server;
use Illuminate\Support\Collection;

interface ServerRepositoryInterface
{
    public function all(): Collection;

    public function getById(int $id): Server;

    public function getLastSortIndex(): int;

    public function getWithLowerSortIdThan($sortId): ?Server;

    public function getWithHigherSortIdThan($sortId): ?Server;

    public function new(array $data): Server;

    public function update(int $serverId, array $data): int;

    public function delete(int $serverId): int;
}
