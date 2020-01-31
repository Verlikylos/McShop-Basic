<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Repositories\Interfaces\ServerRepositoryInterface;
use App\Http\Repositories\Interfaces\ServiceRepositoryInterface;
use App\Http\Repositories\Interfaces\SmsNumberRepositoryInterface;
use App\Http\Requests\StoreServiceRequest;
use App\Http\Requests\UpdateServiceRequest;
use App\Models\Server;
use App\Models\Service;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\View;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;

class ServicesController extends Controller
{
    /**
     * @var ServiceRepositoryInterface
     */
    private $serviceRepository;
    /**
     * @var ServerRepositoryInterface
     */
    private $serverRepository;
    /**
     * @var SmsNumberRepositoryInterface
     */
    private $numberRepository;
    
    public function __construct(ServiceRepositoryInterface $serviceRepository, ServerRepositoryInterface $serverRepository, SmsNumberRepositoryInterface $numberRepository)
    {
        $this->serviceRepository = $serviceRepository;
        $this->serverRepository = $serverRepository;
        $this->numberRepository = $numberRepository;
    }
    
    public function index(Server $server)
    {
        $servers = $this->serverRepository->all();
        
        if (!$server->exists) {
            $server = $this->serverRepository->getFirstServer(true);
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
    
        return Redirect::route('admin.services.index', ['server' => $service->getServer()->getSlug()])
            ->with('sessionMessage', ['type' => 'success', 'content' =>
                'Pomyślnie dodano usługę o nazwie ' .
                '<span class="font-weight-bold">' . $service->getName() .
                ' (ID: #' . $service->getId() . ')</span>' .
                ' dla serwera <span class="font-weight-bold"> ' .
                $service->getServer()->getName() . ' (ID: #' .
                $service->getServer()->getId() . ')</span>!']);
    }
    
    public function toggle_active(Service $service) {
        $this->serviceRepository->update($service, ['active' => !$service->isActive()]);
        
        $message = 'Usługa <span class="font-weight-bold">' . $service->getName() .
            ' (ID: #' . $service->getId() . ')</span> została pomyślnie aktywowana!';
        
        if ($service->isActive()) {
            $message = str_replace('aktywowana', 'dezaktywowana', $message);
            
            return Redirect::back()
                ->with('sessionMessage', ['type' => 'success', 'content' => $message]);
        }
        
        return Redirect::back()
            ->with('sessionMessage', ['type' => 'success', 'content' => $message]);
    }
    
    public function swap(Service $service, bool $up)
    {
        $secondService = null;
        
        if ($up) {
            $secondService = $this->serviceRepository->getWithHigherSortIdThan($service);
        } else {
            $secondService = $this->serviceRepository->getWithLowerSortIdThan($service);
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
        
        return Redirect::back()
            ->with('sessionMessage', ['type' => 'success', 'content' =>
                'Pozycja usługi <span class="font-weight-bold">' . $service->getName() .
                ' (ID: #' . $service->getId() . ')</span> została zaktualizowana!']);
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
    
        return Redirect::route('admin.services.index', ['server' => $service->getServer()->getSlug()])
            ->with('sessionMessage', ['type' => 'success', 'content' =>
                'Pomyślnie zaktualizowano usługę o nazwie ' .
                '<span class="font-weight-bold">' . $service->getName() .
                ' (ID: #' . $service->getId() . ')</span>' .
                ' z serwera <span class="font-weight-bold"> ' .
                $service->getServer()->getName() . ' (ID: #' .
                $service->getServer()->getId() . ')</span>!']);
    }
    
    // TODO do delete request of all entities with HTTP DELETE method instead of GET
    public function delete(Service $service)
    {
        $this->serviceRepository->delete($service);
    
        return Redirect::route('admin.services.index', ['server' => $service->getServer()->getSlug()])
            ->with('sessionMessage', ['type' => 'success', 'content' =>
                'Pomyślnie usunięto usługę o nazwie ' .
                '<span class="font-weight-bold">' . $service->getName() .
                ' (ID: #' . $service->getId() . ')</span>' .
                ' z serwera <span class="font-weight-bold"> ' .
                $service->getServer()->getName() . ' (ID: #' .
                $service->getServer()->getId() . ')</span>!']);
    }
}
