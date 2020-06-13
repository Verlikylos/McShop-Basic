<?php


namespace App\Http\Repositories;


use App\Models\Log;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

interface LogRepositoryInterface
{
    public function paginate(): LengthAwarePaginator;
    
    public function new(array $data): Log;
}
