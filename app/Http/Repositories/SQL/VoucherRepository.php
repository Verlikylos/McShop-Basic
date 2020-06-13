<?php


namespace App\Http\Repositories\SQL;


use App\Http\Repositories\VoucherRepositoryInterface;
use App\Models\Voucher;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;

class VoucherRepository implements VoucherRepositoryInterface
{
    private $table = 'vouchers';
    
    public function getForTable(): LengthAwarePaginator
    {
        return Voucher::with('service')->orderByDesc('id')->paginate(15);
    }
    
    public function insertMany(array $vouchers): void
    {
        
        DB::table($this->table)->insert($vouchers);
    }
    
    public function delete(Voucher $voucher): int
    {
        return DB::table($this->table)->where('id', $voucher->getId())->delete();
    }
}
