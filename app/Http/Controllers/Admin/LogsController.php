<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Repositories\LogRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

class LogsController extends Controller
{
    private $logRepository;
    
    public function __construct(LogRepositoryInterface $logRepository)
    {
        $this->logRepository = $logRepository;
    }
    
    public function acp()
    {
        $logs = $this->logRepository->paginate();
        
        return View::make('admin.logs.acp')->with(['logs' => $logs]);
    }
}
