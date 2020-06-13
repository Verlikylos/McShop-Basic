<?php


namespace App\Http\Repositories\SQL;


use App\Http\Repositories\SmsNumberRepositoryInterface;
use App\Models\SmsNumber;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class SmsNumberRepository implements SmsNumberRepositoryInterface
{
    private $table = 'sms_numbers';
    
    public function all(): Collection
    {
        return SmsNumber::all();
    }
    
    public function paginateWhereProviderIs(string $provider): LengthAwarePaginator
    {
        return SmsNumber::where('provider', $provider)->paginate(10);
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
