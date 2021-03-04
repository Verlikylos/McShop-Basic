<?php

namespace App\Http\Controllers\Admin\Settings\Payments;

use App\Http\Controllers\Controller;
use App\Http\Repositories\LogRepositoryInterface;
use App\Http\Requests\UpdateMicroSmsPaymentSettingsRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\View;

class MicroSmsController extends Controller
{
    private $logRepository;
    
    public function __construct(LogRepositoryInterface $logRepository)
    {
        $this->logRepository = $logRepository;
    }
    
    public function index()
    {
        return View::make('admin.settings.payments.microsms');
    }
    
    public function update(UpdateMicroSmsPaymentSettingsRequest $request)
    {
        setting([
            'settings_payments_microsms_userid' => $request->get('microsmsUserId'),
            'settings_payments_microsms_sms_serviceid' => $request->get('microsmsSmsChannelId'),
            'settings_payments_microsms_sms_channel' => $request->get('microsmsSmsChannel'),
        ])->save();
        
        $this->logRepository->new([
            'category' => 'SETTINGS',
            'color' => 'primary',
            'details' => Lang::get('admin.settings.logs.payments.provider', [
                'provider' => config('mcshop.payment_providers.sms.microsms.name')
            ])
        ]);
        
        return Redirect::route('admin.settings.payments.microsms.index')
            ->with('sessionMessage',[
                'type' => 'success',
                'content' => Lang::get('admin.settings.saved')
            ]);
    }
}
