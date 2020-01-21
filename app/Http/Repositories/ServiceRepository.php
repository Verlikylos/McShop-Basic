<?php


namespace App\Http\Repositories;


use App\Http\Repositories\Interfaces\ServiceRepositoryInterface;
use App\Models\Server;
use App\Models\Service;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;

class ServiceRepository implements ServiceRepositoryInterface
{
    private $table = 'services';
    
    /**
     * @inheritDoc
     */
    public function orderBySortIdDescAndPaginate(int $itemsPerPage = 10, bool $withServers = false, bool $withSmsNumbers = false): LengthAwarePaginator
    {
        $query = Service::orderBy('sort_id', 'desc');
        
        if ($withServers) {
            $query->with('server');
        }
        
        if ($withSmsNumbers) {
            $query->with('smsnumber');
        }
        
        return $query->paginate($itemsPerPage);
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
    public function getWithLowerSortIdThan($sortId): ?Service
    {
        return Service::orderBy('sort_id', 'desc')->where('sort_id', '<', $sortId)->first();
    }
    
    /**
     * @inheritDoc
     */
    public function getWithHigherSortIdThan($sortId): ?Service
    {
        return Service::orderBy('sort_id')->where('sort_id', '>', $sortId)->first();
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
    public function update(Server $server, array $data): int
    {
        return DB::table($this->table)->where('id', $server->getId())->update($data);
    }
    
    /**
     * @inheritDoc
     */
    public function delete(Server $server): int
    {
        return DB::table($this->table)->where('id', $server->getId())->delete();
    }
}
