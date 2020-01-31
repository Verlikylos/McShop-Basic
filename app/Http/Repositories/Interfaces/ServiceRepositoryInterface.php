<?php


namespace App\Http\Repositories\Interfaces;


use App\Models\Server;
use App\Models\Service;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

interface ServiceRepositoryInterface
{
    
    /**
     * @param  Server  $server
     * @param  int  $itemsPerPage
     * @return LengthAwarePaginator
     */
    public function paginateServerServices(Server $server, int $itemsPerPage = 10): LengthAwarePaginator;
    
    /**
     * @return int
     */
    public function getLastSortIndex(): int;
    
    /**
     * @param Service $service
     * @return Service|null
     */
    public function getWithLowerSortIdThan(Service $service): ?Service;
    
    /**
     * @param Service $service
     * @return Service|null
     */
    public function getWithHigherSortIdThan(Service $service): ?Service;
    
    /**
     * @param  array  $data
     * @return Service
     */
    public function new(array $data): Service;
    
    /**
     * @param  Service  $service
     * @param  array  $data
     * @return int
     */
    public function update(Service $service, array $data): int;
    
    /**
     * @param  Service  $service
     * @return int
     */
    public function delete(Service $service): int;
}
