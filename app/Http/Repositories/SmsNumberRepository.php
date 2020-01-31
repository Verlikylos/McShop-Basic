<?php


namespace App\Http\Repositories;


use App\Http\Repositories\Interfaces\SmsNumberRepositoryInterface;
use App\Models\SmsNumber;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class SmsNumberRepository implements SmsNumberRepositoryInterface
{
    private $table = 'sms_numbers';
    
    public function all(): Collection
    {
        return SmsNumber::all();
    }
    
    public function paginateWhereOperatorIs(string $operator): LengthAwarePaginator
    {
        return SmsNumber::where('operator', $operator)->paginate(10);
    }
    
    public function new(array $data): SmsNumber
    {
        $number = new SmsNumber($data);
        $number->save();
        
        return $number;
    }
    
    public function delete(int $numberId): int
    {
        return DB::table($this->table)->where('id', $numberId)->delete();
    }
}
