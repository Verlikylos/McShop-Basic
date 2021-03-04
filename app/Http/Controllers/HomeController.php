<?php

namespace App\Http\Controllers;

use App\Http\Repositories\PageRepositoryInterface;
use App\Http\Repositories\ServerRepositoryInterface;
use App\Http\Repositories\ServiceRepositoryInterface;
use App\Models\Server;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Session;
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
    /**
     * @var PagesRepositoryInterface
     */
    private $pagesRepository;
    
    public function __construct(ServerRepositoryInterface $serverRepository, ServiceRepositoryInterface $serviceRepository, PageRepositoryInterface $pagesRepository)
    {
        $this->serverRepository = $serverRepository;
        $this->serviceRepository = $serviceRepository;
        $this->pagesRepository = $pagesRepository;
    }
    
    public function index(Server $server)
    {
        $pages = $this->pagesRepository->getActive();
        
        if (!$server->exists) {
            $servers = $this->serverRepository->getAllActive();
            
            if ($servers->count() > 1) {
                return View::make('servers')->with(['servers' => $servers, 'pages' => $pages]);
            }
            
            $server = $servers->first();
        }
        
        if ($server == null || !$server->exists) {
            return View::make('servers')->with(['servers' => [], 'pages' => $pages]);
        }
    
        if (!$server->isActive()) {
            if (Auth::user()) {
                Session::flash('shopSessionMessage', [
                    'type' => 'warning',
                    'content' => Lang::get('main.server.not_active', [
                        'link' => '<a href="' . route('admin.servers.index') . '">',
                        'endlink' => '</a>'
                    ])
                ]);
            } else {
                return abort(404);
            }
        }
        
        $services = $this->serviceRepository->paginateServerServices($server, 4, true, true);
        
        return View::make('shop')->with(['server' => $server, 'services' => $services, 'pages' => $pages]);
    }
}
