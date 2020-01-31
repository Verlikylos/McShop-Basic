<?php

namespace App\Http\Controllers;

use App\Http\Repositories\Interfaces\ServerRepositoryInterface;
use App\Http\Repositories\Interfaces\ServiceRepositoryInterface;
use App\Models\Server;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

class HomeController extends Controller
{
    /**
     * @var ServerRepositoryInterface
     */
    private $serverRepository;
    /**
     * @var ServiceRepositoryInterface
     */
    private $serviceRepository;
    
    public function __construct(ServerRepositoryInterface $serverRepository, ServiceRepositoryInterface $serviceRepository)
    {
        $this->serverRepository = $serverRepository;
        $this->serviceRepository = $serviceRepository;
    }
    
    public function index(Server $server)
    {
        $servers = $this->serverRepository->all();
        
        if (!$server->exists) {
            if ($servers->count() > 1) {
                return View::make('servers')->with(['servers' => $servers]);
            }
            
            $server = $servers->first();
        }
        
        $services = $this->serviceRepository->paginateServerServices($server, 6);
        
        return View::make('shop')->with(['server' => $server, 'services' => $services]);
    }
}
