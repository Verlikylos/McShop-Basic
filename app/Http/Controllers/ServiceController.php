<?php

namespace App\Http\Controllers;

use App\Facades\PaymentManager;
use App\Http\Repositories\PageRepositoryInterface;
use App\Models\Server;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\View;

class ServiceController extends Controller
{
    /**
     * @var PageRepositoryInterface
     */
    private $pagesRepository;
    
    public function __construct(PageRepositoryInterface $pagesRepository)
    {
        $this->pagesRepository = $pagesRepository;
    }
    
    public function index(Server $server, Service $service)
    {
        if (!$service->isActive() || !$server->isActive()) {
            if (Auth::user()) {
                Session::flash('shopSessionMessage', [
                    'type' => 'warning',
                    'content' => Lang::get('main.service.not_active', [
                        'link' => '<a href="' . route('admin.services.index') . '">',
                        'endlink' => '</a>'
                    ])
                ]);
            } else {
                return abort(404);
            }
        }
        
        $pages = $this->pagesRepository->getActive();
        
        return View::make('service', ['server' => $server, 'service' => $service, 'pages' => $pages]);
    }
}
