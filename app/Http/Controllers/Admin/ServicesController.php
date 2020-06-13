<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Repositories\LogRepositoryInterface;
use App\Http\Repositories\ServerRepositoryInterface;
use App\Http\Repositories\ServiceRepositoryInterface;
use App\Http\Repositories\SmsNumberRepositoryInterface;
use App\Http\Requests\StoreServiceRequest;
use App\Http\Requests\UpdateServiceRequest;
use App\Models\Server;
use App\Models\Service;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\View;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;

class ServicesController extends Controller
{
    private $serviceRepository;
    private $serverRepository;
    private $numberRepository;
    private $logRepository;
    
    public function __construct(
        ServiceRepositoryInterface $serviceRepository,
        ServerRepositoryInterface $serverRepository,
        SmsNumberRepositoryInterface $numberRepository,
        LogRepositoryInterface $logRepository
    )
    {
        $this->serviceRepository = $serviceRepository;
        $this->serverRepository = $serverRepository;
        $this->numberRepository = $numberRepository;
        $this->logRepository = $logRepository;
    }
    
    public function index(Server $server)
    {
        $servers = $this->serverRepository->all();
        
        if (!$server->exists) {
            $server = $servers->first();
        }
        
        $services = $this->serviceRepository->paginateServerServices($server);
        
        return View::make('admin.services.index')->with(['services' => $services, 'servers' => $servers, 'activeServer' => $server]);
    }
    
    public function create()
    {
        $servers = $this->serverRepository->all();
        
        // TODO get only numbers for currently active sms operator
        $numbers = $this->numberRepository->all();
        
        return View::make('admin.services.create')->with(['servers' => $servers, 'numbers' => $numbers]);
    }
    
    public function store(StoreServiceRequest $request)
    {
        $data = [
            'name' => $request->get('serviceName'),
            'slug' => str_replace('+', '-', strtolower(urlencode($request->get('serviceName')))),
            'server_id' => $request->get('serviceServer'),
            'description' => $request->get('serviceDescription'),
            'requires_online_player' => $request->has('serviceRequiresPlayer'),
            'commands' => json_decode($request->get('serviceCommands')),
            'smsnumber_id' => $request->get('serviceSmsNumber'),
            'psc_cost' => $request->has('servicePscCost') ? intval(floatval($request->get('servicePscCost')) * 100) : null,
            'transfer_cost' => $request->has('serviceTransferCost') ? intval(floatval($request->get('serviceTransferCost')) * 100) : null,
            'paypal_cost' => $request->has('servicePaypalCost') ? intval(floatval($request->get('servicePaypalCost')) * 100) : null,
            'active' => false,
            'sort_id' => $this->serviceRepository->getLastSortIndex() + 1
        ];
    
        if ($request->hasFile('serviceImage') && $request->file('serviceImage')->isValid()) {
            $data['image_url'] = asset(str_replace('public/', '', $request->file('serviceImage')->storePublicly('public/uploads/services')));
        }
        
        $service = $this->serviceRepository->new($data);
    
        $this->logRepository->new([
            'category' => 'SERVICES',
            'color' => 'success',
            'details' => Lang::get('admin.services.logs.created', [
                'service' => $service->getName(),
                'service_id' => $service->getId(),
                'server' => $service->getServer()->getName(),
                'server_id' => $service->getServer()->getId(),
            ])
        ]);
    
        return Redirect::route(
                'admin.services.index',
                ['server' => $service->getServer()->getSlug()]
            )
            ->with('sessionMessage', [
                'type' => 'success',
                'content' => Lang::get('admin.services.created', [
                    'service' => $service->getName(),
                    'service_id' => $service->getId(),
                    'server' => $service->getServer()->getName(),
                    'server_id' => $service->getServer()->getId(),
                ])
            ]);
    }
    
    public function toggle_active(Service $service) {
        $this->serviceRepository->update($service, ['active' => !$service->isActive()]);
        
        if ($service->isActive()) {
            $this->logRepository->new([
                'category' => 'SERVICES',
                'color' => 'primary',
                'details' => Lang::get('admin.services.logs.status.disabled', [
                    'service' => $service->getName(),
                    'service_id' => $service->getId(),
                    'server' => $service->getServer()->getName(),
                    'server_id' => $service->getServer()->getId(),
                ])
            ]);
            
            return Redirect::back()
                ->with('sessionMessage', [
                    'type' => 'success',
                    'content' => Lang::get('admin.services.status.disabled', [
                        'service' => $service->getName(),
                        'service_id' => $service->getId(),
                        'server' => $service->getServer()->getName(),
                        'server_id' => $service->getServer()->getId(),
                    ])
                ]);
        }
    
        $this->logRepository->new([
            'category' => 'SERVICES',
            'color' => 'primary',
            'details' => Lang::get('admin.services.logs.status.enabled', [
                'service' => $service->getName(),
                'service_id' => $service->getId(),
                'server' => $service->getServer()->getName(),
                'server_id' => $service->getServer()->getId(),
            ])
        ]);
        
        return Redirect::back()
            ->with('sessionMessage', [
                'type' => 'success',
                'content' => Lang::get('admin.services.status.enabled', [
                    'service' => $service->getName(),
                    'service_id' => $service->getId(),
                    'server' => $service->getServer()->getName(),
                    'server_id' => $service->getServer()->getId(),
                ])
            ]);
    }
    
    public function swap(Service $service, bool $up)
    {
        $secondService = null;
        
        if ($up) {
            $secondService = $this->serviceRepository->getWithLowerSortIdThan($service);
        } else {
            $secondService = $this->serviceRepository->getWithHigherSortIdThan($service);
        }
        
        if ($secondService == null) {
            throw new BadRequestHttpException();
        }
        
        $firstServiceData = [
            'sort_id' => $secondService->getSortId()
        ];
        
        $secondServiceData = [
            'sort_id' => $service->getSortId()
        ];
        
        $this->serviceRepository->update($service, $firstServiceData);
        $this->serviceRepository->update($secondService, $secondServiceData);
    
        $this->logRepository->new([
            'category' => 'SERVICES',
            'color' => 'primary',
            'details' => Lang::get('admin.services.logs.order.updated', [
                'service' => $service->getName(),
                'service_id' => $service->getId(),
                'server' => $service->getServer()->getName(),
                'server_id' => $service->getServer()->getId(),
            ])
        ]);
        
        return Redirect::back()
            ->with('sessionMessage', [
                'type' => 'success',
                'content' => Lang::get('admin.services.order.updated', [
                    'service' => $service->getName(),
                    'service_id' => $service->getId(),
                    'server' => $service->getServer()->getName(),
                    'server_id' => $service->getServer()->getId(),
                ])
            ]);
    }
    
    public function edit(Service $service)
    {
        // TODO get numbers of active operator
        $numbers = $this->numberRepository->all();
        $servers = $this->serverRepository->all();
        
        return View::make('admin.services.edit', ['service' => $service, 'servers' => $servers, 'numbers' => $numbers]);
    }
    
    public function update(UpdateServiceRequest $request, Service $service)
    {
        $data = [
            'name' => $request->get('serviceName'),
            'slug' => str_replace('+', '-', strtolower(urlencode($request->get('serviceName')))),
            'server_id' => $request->get('serviceServer'),
            'description' => $request->get('serviceDescription'),
            'requires_online_player' => $request->has('serviceRequiresPlayer'),
            'commands' => json_decode($request->get('serviceCommands')),
            'smsnumber_id' => $request->get('serviceSmsNumber'),
            'psc_cost' => $request->has('servicePscCost') ? intval(floatval($request->get('servicePscCost')) * 100) : null,
            'transfer_cost' => $request->has('serviceTransferCost') ? intval(floatval($request->get('serviceTransferCost')) * 100) : null,
            'paypal_cost' => $request->has('servicePaypalCost') ? intval(floatval($request->get('servicePaypalCost')) * 100) : null
        ];
    
        if ($request->hasFile('serviceImage') && $request->file('serviceImage')->isValid()) {
            $data['image_url'] = asset(str_replace('public/', '', $request->file('serviceImage')->storePublicly('public/uploads/services')));
        }
    
        $this->serviceRepository->update($service, $data);
    
        $this->logRepository->new([
            'category' => 'SERVICES',
            'color' => 'info',
            'details' => Lang::get('admin.services.logs.updated', [
                'service' => $service->getName(),
                'service_id' => $service->getId(),
                'server' => $service->getServer()->getName(),
                'server_id' => $service->getServer()->getId(),
            ])
        ]);
    
        return Redirect::route('admin.services.index', [
                'server' => $service->getServer()->getSlug()
            ])
            ->with('sessionMessage', [
                'type' => 'success',
                'content' => Lang::get('admin.services.updated', [
                    'service' => $service->getName(),
                    'service_id' => $service->getId(),
                    'server' => $service->getServer()->getName(),
                    'server_id' => $service->getServer()->getId(),
                ])
            ]);
    }
    
    // TODO make delete request of all entities with HTTP DELETE method instead of GET
    public function delete(Service $service)
    {
        $this->serviceRepository->delete($service);
    
        $this->logRepository->new([
            'category' => 'SERVICES',
            'color' => 'danger',
            'details' => Lang::get('admin.services.logs.deleted', [
                'service' => $service->getName(),
                'service_id' => $service->getId(),
                'server' => $service->getServer()->getName(),
                'server_id' => $service->getServer()->getId(),
            ])
        ]);
    
        return Redirect::route('admin.services.index', [
                'server' => $service->getServer()->getSlug()
            ])
            ->with('sessionMessage', [
                'type' => 'success',
                'content' => Lang::get('admin.services.deleted', [
                    'service' => $service->getName(),
                    'service_id' => $service->getId(),
                    'server' => $service->getServer()->getName(),
                    'server_id' => $service->getServer()->getId(),
                ])
            ]);
    }
}
