<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Repositories\OrderRepositoryInterface;
use App\Http\Repositories\PageRepositoryInterface;
use App\Http\Repositories\PaymentRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\View;
use Ramsey\Uuid\Uuid;

class OrderController extends Controller
{
    private $orderRepository;
    private $pageRepository;
    
    public function __construct(OrderRepositoryInterface $orderRepository, PageRepositoryInterface $pageRepository)
    {
        $this->orderRepository = $orderRepository;
        $this->pageRepository = $pageRepository;
    }
    
    public function index(Request $request, $orderHash)
    {
        $orderHash = Uuid::fromString($orderHash);
        
        if ($orderHash === null) {
            return abort(404);
        }
        
        $order = $this->orderRepository->getByHash($orderHash, true);
        
        if ($order === null) {
            return abort(404);
        }
        
        $pages = $this->pageRepository->getActive();
        
        return View::make('order')->with(['order' => $order, 'pages' => $pages]);
    }
}
