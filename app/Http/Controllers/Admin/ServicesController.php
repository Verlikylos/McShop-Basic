<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Repositories\Interfaces\ServiceRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

class ServicesController extends Controller
{
    /**
     * @var ServiceRepositoryInterface
     */
    private $serviceRepository;
    
    public function __construct(ServiceRepositoryInterface $serviceRepository)
    {
        $this->serviceRepository = $serviceRepository;
    }
    
    public function index()
    {
        $services = $this->serviceRepository->orderBySortIdDescAndPaginate(10, true);
        
        return View::make('admin.services.index')->with(['services' => $services]);
    }
}
