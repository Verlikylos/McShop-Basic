<?php


namespace App\Http\Repositories;


use App\Models\SmsNumber;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

interface SmsNumberRepositoryInterface
{
    public function all(): Collection;
    
    public function paginateWhereProviderIs(string $provider): LengthAwarePaginator;
    
    public function new(array $data): SmsNumber;
    
    public function delete(int $numberId): int;
}
