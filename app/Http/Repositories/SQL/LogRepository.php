<?php


namespace App\Http\Repositories\SQL;


use App\Http\Repositories\LogRepositoryInterface;
use App\Models\Log;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Auth;

class LogRepository implements LogRepositoryInterface
{
    public function paginate(): LengthAwarePaginator
    {
        return Log::with('user')->orderByDesc('id')->paginate(15);
    }
    
    public function new(array $data): Log
    {
        $data['date'] = now();
        
        $log = new Log($data);
        
        $log->user()->associate(Auth::user());
        $log->save();
        
        return $log;
    }
}
