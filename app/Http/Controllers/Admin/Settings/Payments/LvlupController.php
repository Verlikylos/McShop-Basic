<?php

namespace App\Http\Controllers\Admin\Settings\Payments;

use App\Http\Controllers\Controller;
use App\Http\Repositories\LogRepositoryInterface;
use App\Http\Requests\UpdateLvlupPaymentSettingsRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\View;

class LvlupController extends Controller
{
    private $logRepository;
    
    public function __construct(LogRepositoryInterface $logRepository)
    {
        $this->logRepository = $logRepository;
    }
    
    public function index()
    {
        return View::make('admin.settings.payments.lvlup');
    }
    
    public function update(UpdateLvlupPaymentSettingsRequest $request)
    {
        setting([
            'settings_payments_lvlup_apiKey' => $request->get('lvlupApiKey'),
        ])->save();
        
        $this->logRepository->new([
            'category' => 'SETTINGS',
            'color' => 'primary',
            'details' => Lang::get('admin.settings.logs.payments.provider', [
                'provider' => config('mcshop.payment_providers.sms.lvlup.name')
            ])
        ]);
        
        return Redirect::route('admin.settings.payments.lvlup.index')
            ->with('sessionMessage',[
                'type' => 'success',
                'content' => Lang::get('admin.settings.saved')
            ]);
    }
}
