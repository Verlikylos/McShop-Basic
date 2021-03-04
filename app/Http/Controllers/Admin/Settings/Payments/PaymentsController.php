<?php

namespace App\Http\Controllers\Admin\Settings\Payments;

use App\Http\Controllers\Controller;
use App\Http\Repositories\LogRepositoryInterface;
use App\Http\Requests\UpdatePaymentSettingsRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\View;

class PaymentsController extends Controller
{
    private $logRepository;
    
    public function __construct(LogRepositoryInterface $logRepository)
    {
        $this->logRepository = $logRepository;
    }
    
    public function index()
    {
        return View::make('admin.settings.payments.index');
    }
    
    public function update(UpdatePaymentSettingsRequest $request)
    {
        setting([
            'settings_payments_sms_operator' => $request->get('paymentSmsOperator'),
            'settings_payments_psc_operator' => $request->get('paymentPscOperator')
        ])->save();
    
        $this->logRepository->new([
            'category' => 'SETTINGS',
            'color' => 'primary',
            'details' => Lang::get('admin.settings.logs.payments.general')
        ]);
    
        return Redirect::route('admin.settings.payments.index')
            ->with('sessionMessage',[
                'type' => 'success',
                'content' => Lang::get('admin.settings.saved')
            ]);
    }
}
