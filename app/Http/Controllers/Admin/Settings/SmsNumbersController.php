<?php

namespace App\Http\Controllers\Admin\Settings;

use App\Http\Controllers\Controller;
use App\Http\Repositories\LogRepositoryInterface;
use App\Http\Repositories\SmsNumberRepositoryInterface;
use App\Http\Requests\StoreSmsNumberRequest;
use App\Models\SmsNumber;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\View;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;

class SmsNumbersController extends Controller
{
    private $numberRepository;
    private $logRepository;
    
    public function __construct(SmsNumberRepositoryInterface $numberRepository, LogRepositoryInterface $logRepository)
    {
        $this->numberRepository = $numberRepository;
        $this->logRepository = $logRepository;
    }

    public function index()
    {
        if (setting('settings_payments_sms_operator', null) == null) {
            return Redirect::route('admin.settings.payments.index')->with('sessionMessage', [
                'type' => 'success',
                'content' => Lang::get('admin.payments.no_setup')
            ]);
        }
        
        $numbers = $this->numberRepository->paginateWhereProviderIs(setting('settings_payments_sms_operator'));

        return View::make('admin.settings.numbers.index')->with(['numbers' => $numbers, 'activeProvider' => setting('settings_payments_sms_operator')]);
    }
    
    public function create()
    {
        return View::make('admin.settings.numbers.create');
    }
    
    public function store(StoreSmsNumberRequest $request)
    {
        $data = [
            'provider' => $request->get('numberProvider'),
            'number' => $request->get('numberNumber'),
            'netto_cost' => $request->get('numberNetto') * 100,
        ];
        
        $number = $this->numberRepository->new($data);
    
        $this->logRepository->new([
            'category' => 'NUMBERS',
            'color' => 'success',
            'details' => Lang::get('admin.numbers.logs.created', [
                'number' => $number->getNumber(),
                'number_id' => $number->getId(),
                'provider' => config('mcshop.payment_providers.sms.' . $number->getProvider() . '.name')
            ])
        ]);
    
        return Redirect::route('admin.settings.numbers.index')
            ->with('sessionMessage', [
                'type' => 'success',
                'content' => Lang::get('admin.numbers.created', [
                    'number' => $number->getNumber(),
                    'number_id' => $number->getId(),
                    'provider' => config('mcshop.payment_providers.sms.' . $number->getProvider() . '.name')
                ])
            ]);
    }
    
    public function delete(SmsNumber $number)
    {
        $this->numberRepository->delete($number->getId());
    
        $this->logRepository->new([
            'category' => 'NUMBERS',
            'color' => 'danger',
            'details' => Lang::get('admin.numbers.logs.deleted', [
                'number' => $number->getNumber(),
                'number_id' => $number->getId(),
                'provider' => config('mcshop.payment_providers.sms.' . $number->getProvider() . '.name')
            ])
        ]);
    
        return Redirect::route('admin.settings.numbers.index')
            ->with('sessionMessage', [
                'type' => 'success',
                'content' => Lang::get('admin.numbers.deleted', [
                    'number' => $number->getNumber(),
                    'number_id' => $number->getId(),
                    'provider' => config('mcshop.payment_providers.sms.' . $number->getProvider() . '.name')
                ])
            ]);
    }
}
