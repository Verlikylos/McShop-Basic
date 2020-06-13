<?php

namespace App\Http\Controllers\Admin\Settings;

use App\Http\Controllers\Controller;
use App\Http\Repositories\LogRepositoryInterface;
use App\Http\Requests\UpdateVoucherSettingsRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\View;

class VoucherController extends Controller
{
    private $logRepository;
    
    public function __construct(LogRepositoryInterface $logRepository)
    {
        $this->logRepository = $logRepository;
    }
    
    public function index()
    {
        return View::make('admin.settings.voucher');
    }
    
    public function update(UpdateVoucherSettingsRequest $request)
    {
        setting([
            'voucher_default_prefix' => $request->get('voucherDefaultPrefix', ''),
            'voucher_default_code_length' => $request->get('voucherDefaultCodeLength')
        ])->save();
    
        $this->logRepository->new([
            'category' => 'SETTINGS',
            'color' => 'primary',
            'details' => Lang::get('admin.settings.logs.voucher')
        ]);
    
        return Redirect::route('admin.settings.voucher.index')
            ->with('sessionMessage',[
                'type' => 'success',
                'content' => Lang::get('admin.settings.saved')
            ]);
    }
}
