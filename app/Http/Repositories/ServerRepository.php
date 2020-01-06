<?php


namespace App\Http\Repositories;


use App\Http\Repositories\Interfaces\ServerRepositoryInterface;
use App\Models\Server;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Collection;

class ServerRepository implements ServerRepositoryInterface
{

    public function all(): Collection
    {
        return Server::all();
    }

    public function getById(int $id): Server
    {
        return Server::findOrFail($id);
    }

    public function getLastSortIndex(): int
    {
        try {
            return Server::orderByDesc('sort_id')->firstOrFail()->getSortId();
        } catch (ModelNotFoundException $e) {
            return 0;
        }
    }

    public function new(array $data): Server
    {
        if (!isset($data['image_url'])) {
            $data['image_url'] = asset('images/default-server-image.png');
        }

        $server = new Server($data);
        $server->save();

        return $server;
    }

    public function update(int $serverId, array $data): bool
    {
        return Server::findOrFail($serverId)->update($data);
    }

    public function delete(int $serverId): bool
    {
        return Server::findOrFail($serverId)->delete();
    }
}
