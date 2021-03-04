<?php


namespace App\Http\Repositories;


use App\Models\Server;
use App\Models\Service;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

interface ServiceRepositoryInterface
{
    
    public function getById(int $id): ?Service;
    
    /**
     * @param  Server  $server
     * @param  int  $itemsPerPage
     * @param  bool $withNumbers
     * @param  bool $onlyActive
     * @return LengthAwarePaginator
     */
    public function paginateServerServices(Server $server, int $itemsPerPage = 10, bool $onlyActive = false, bool $withNumbers = false): LengthAwarePaginator;
    
    public function getServicesWithServers(): Collection;
    
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
