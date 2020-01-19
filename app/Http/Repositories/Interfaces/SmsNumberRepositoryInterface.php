<?php


namespace App\Http\Repositories\Interfaces;


use App\Models\SmsNumber;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

interface SmsNumberRepositoryInterface
{
    public function paginateWhereOperatorIs(string $operator): LengthAwarePaginator;
    
    public function new(array $data): SmsNumber;
    
    public function delete(int $numberId): int;
}
