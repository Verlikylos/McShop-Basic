<?php


namespace App\Http\Repositories\SQL;


use App\Http\Repositories\ServiceRepositoryInterface;
use App\Models\Server;
use App\Models\Service;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class ServiceRepository implements ServiceRepositoryInterface
{
    private $table = 'services';
    
    public function getById(int $id): ?Service
    {
        try {
            return Service::find($id);
        } catch (ModelNotFoundException $e) {
            return null;
        }
    }
    
    public function paginateServerServices(Server $server, int $itemsPerPage = 10, bool $onlyActive = false, bool $withNumbers = false): LengthAwarePaginator
    {
        $query = $server->services()->orderBy('sort_id');
        
        if ($onlyActive) {
            $query->where('active', 1);
        }
        
        if ($withNumbers) {
            $query->with('smsnumber');
        }
    
        return $query->paginate($itemsPerPage);
    }
    
    public function getServicesWithServers(): Collection
    {
        return Service::with('server')->get();
    }
    
    
    /**
     * @inheritDoc
     */
    public function getLastSortIndex(): int
    {
        try {
            return Service::orderBy('sort_id', 'desc')->firstOrFail()->getSortId();
        } catch (ModelNotFoundException $e) {
            return 0;
        }
    }
    
    /**
     * @inheritDoc
     */
    public function getWithLowerSortIdThan(Service $service): ?Service
    {
        return Service::where('server_id', $service->getServer()->getId())->where('sort_id', '<', $service->getSortId())->orderBy('sort_id', 'desc')->first();
    }
    
    /**
     * @inheritDoc
     */
    public function getWithHigherSortIdThan(Service $service): ?Service
    {
        return Service::where('server_id', $service->getServer()->getId())->where('sort_id', '>', $service->getSortId())->orderBy('sort_id')->first();
    }
    
    /**
     * @inheritDoc
     */
    public function new(array $data): Service
    {
        if (!isset($data['image_url'])) {
            $data['image_url'] = asset('images/default-service-image.png');
        }
        
        $service = new Service($data);
        $service->save();
        
        return $service;
    }
    
    /**
     * @inheritDoc
     */
    public function update(Service $service, array $data): int
    {
        return DB::table($this->table)->where('id', $service->getId())->update($data);
    }
    
    /**
     * @inheritDoc
     */
    public function delete(Service $service): int
    {
        return DB::table($this->table)->where('id', $service->getId())->delete();
    }
}
