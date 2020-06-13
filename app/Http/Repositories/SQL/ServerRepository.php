<?php


namespace App\Http\Repositories\SQL;


use App\Http\Repositories\ServerRepositoryInterface;
use App\Models\Server;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class ServerRepository implements ServerRepositoryInterface
{
    private $table = 'servers';
    
    
    public function getAllActive(): Collection
    {
        return Server::where('active', 1)->get();
    }
    
    
    
    
    
    public function getFirstServer(bool $withServices = false): Server
    {
        $server = Server::orderBy('sort_id')->first();
        
        if ($withServices) {
            $server->with('services');
        }
        
        return $server;
    }
    
    
    public function all(): Collection
    {
        return Server::orderBy('sort_id')->get();
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

    public function getWithLowerSortIdThan($sortId): ?Server
    {
        return Server::orderBy('sort_id', 'desc')->where('sort_id', '<', $sortId)->first();
    }

    public function getWithHigherSortIdThan($sortId): ?Server
    {
        return Server::orderBy('sort_id')->where('sort_id', '>', $sortId)->first();
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

    public function update(int $serverId, array $data): int
    {
        return DB::table($this->table)->where('id', $serverId)->update($data);
    }

    public function delete(int $serverId): int
    {
        return DB::table($this->table)->where('id', $serverId)->delete();
    }
}
