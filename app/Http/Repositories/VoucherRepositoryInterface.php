<?php


namespace App\Http\Repositories;


use App\Models\Server;
use App\Models\Voucher;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

interface VoucherRepositoryInterface
{
    public function getForTable(): LengthAwarePaginator;
    
    public function insertMany(array $vouchers): void;
    
    public function delete(Voucher $voucher): int;
}
