<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Repositories\LogRepositoryInterface;
use App\Http\Repositories\ServiceRepositoryInterface;
use App\Http\Repositories\VoucherRepositoryInterface;
use App\Http\Repositories\VoucherRepository;
use App\Http\Requests\GenerateVoucherRequest;
use App\Models\Voucher;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Str;

class VouchersController extends Controller
{
    private $voucherRepository;
    private $serviceRepository;
    private $logRepository;
    
    public function __construct(VoucherRepositoryInterface $voucherRepository, ServiceRepositoryInterface $serviceRepository, LogRepositoryInterface $logRepository)
    {
        $this->voucherRepository = $voucherRepository;
        $this->serviceRepository = $serviceRepository;
        $this->logRepository = $logRepository;
    }
    
    public function index()
    {
        $vouchers = $this->voucherRepository->getForTable();
        
        return View::make('admin.vouchers.index')->with(['vouchers' => $vouchers]);
    }
    
    public function create()
    {
        $services = $this->serviceRepository->getServicesWithServers();
        
        return View::make('admin.vouchers.create', ['services' => $services]);
    }
    
    public function store(GenerateVoucherRequest $request)
    {
        $data = [
            'service_id' => $request->get('voucherService'),
            'usages_amount' => $request->get('voucherUsagesAmount'),
            'many_usages_per_player' => $request->has('voucherManyUsagesPerPlayer'),
            'used_by' => '[]',
            'status' => 'ACTIVE'
        ];
        
        $service = $this->serviceRepository->getById($data['service_id']);
        $voucherPrefix = $request->get('voucherCodePrefix', '');
        $voucherCodeLength = $request->get('voucherCodeLength');
        $generatedVouchers = new Collection();
        
        for ($i = 0; $i < $request->get('voucherAmount'); $i++) {
            $data['code'] = $voucherPrefix . Str::random($voucherCodeLength);
            
            $generatedVouchers->push($data);
        }
        
        $this->voucherRepository->insertMany($generatedVouchers->toArray());
    
        $this->logRepository->new([
            'category' => 'VOUCHERS',
            'color' => 'success',
            'details' => Lang::choice(
                'admin.vouchers.logs.created',
                $generatedVouchers->count(),
                [
                    'service' => $service->getName(),
                    'service_id' => $service->getId(),
                    'server' => $service->getServer()->getName(),
                    'server_id' => $service->getServer()->getId(),
                ])
        ]);
        
        return Redirect::route('admin.vouchers.index')
            ->with([
                'vouchersMessage' => Lang::choice(
                    'admin.vouchers.created',
                    $generatedVouchers->count(),
                    [
                        'service' => $service->getName(),
                        'service_id' => $service->getId(),
                        'server' => $service->getServer()->getName(),
                        'server_id' => $service->getServer()->getId(),
                    ]
                ),
                'generatedVouchers' => $generatedVouchers->pluck('code')
            ]);
    }
    
    // TODO make delete request of all entities with HTTP DELETE method instead of GET
    public function delete(Voucher $voucher)
    {
        $this->voucherRepository->delete($voucher);
    
        $this->logRepository->new([
            'category' => 'VOUCHERS',
            'color' => 'danger',
            'details' => Lang::get('admin.vouchers.logs.deleted', [
                'service' => $voucher->getService()->getName(),
                'service_id' => $voucher->getService()->getId(),
                'server' => $voucher->getService()->getServer()->getName(),
                'server_id' => $voucher->getService()->getServer()->getId(),
            ])
        ]);
    
        return Redirect::route('admin.vouchers.index')
            ->with('sessionMessage', [
                'type' => 'success',
                'content' => Lang::get('admin.vouchers.deleted', [
                    'service' => $voucher->getService()->getName(),
                    'service_id' => $voucher->getService()->getId(),
                    'server' => $voucher->getService()->getServer()->getName(),
                    'server_id' => $voucher->getService()->getServer()->getId(),
                ])
            ]);
    }
}
