<?php


namespace App\Http\Repositories\Interfaces;


use App\Models\Server;
use App\Models\Service;
use Illuminate\Pagination\LengthAwarePaginator;

interface ServiceRepositoryInterface
{
    /**
     * @param  int  $itemsPerPage
     * @return LengthAwarePaginator
     */
    public function orderBySortIdAndPaginate(int $itemsPerPage = 10): LengthAwarePaginator;
    
    /**
     * @return int
     */
    public function getLastSortIndex(): int;
    
    /**
     * @param $sortId
     * @return Service|null
     */
    public function getWithLowerSortIdThan($sortId): ?Service;
    
    /**
     * @param $sortId
     * @return Service|null
     */
    public function getWithHigherSortIdThan($sortId): ?Service;
    
    /**
     * @param  array  $data
     * @return Service
     */
    public function new(array $data): Service;
    
    /**
     * @param  Server  $server
     * @param  array  $data
     * @return int
     */
    public function update(Server $server, array $data): int;
    
    /**
     * @param  Server  $server
     * @return int
     */
    public function delete(Server $server): int;
}
