<?php


namespace App\Http\Repositories\Interfaces;


use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

interface SmsNumberRepositoryInterface
{
    public function paginateWhereOperatorIs(string $operator): LengthAwarePaginator;
}
