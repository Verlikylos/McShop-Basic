<?php


namespace App\Http\Repositories;


use App\Http\Repositories\Interfaces\SmsNumberRepositoryInterface;
use App\Models\SmsNumber;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

class SmsNumberRepository implements SmsNumberRepositoryInterface
{

    public function paginateWhereOperatorIs(string $operator): LengthAwarePaginator
    {
        return SmsNumber::where('operator', $operator)->paginate(10);
    }
}
