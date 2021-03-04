<?php


namespace App\Payments\Psc;


use App\Models\Server;
use App\Models\Service;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Lang;

class LvlupPscPayment implements WhiteLabelPscPayment
{
    private $apiUrl = 'https://api.lvlup.pro/v4/wallet/up';
    private $errorMessage;
    
    public function isWhiteLabel(): bool
    {
        return true;
    }
    
    public function register(Service $service, Server $server): ?array
    {
        $request = Http::withHeaders([
            'Authorization' => setting('settings_payments_lvlup_apiKey')
        ])->post($this->apiUrl, [
            ''
        ]);
        
        if (!$request->ok()) {
            $this->errorMessage = Lang::get('main.payments.general_error');
    
            $this->isValid = false;
            return;
        }
        
        $request = $request->object();
        
        if (!is_object($request)) {
            $this->errorMessage = Lang::get('main.payments.general_error');
    
            $this->isValid = false;
            return;
        }
        
        if (!(isset($request->id)) || !(isset($request->url))) {
            $this->errorMessage = Lang::get('main.payments.general_error');
    
            $this->isValid = false;
            return null;
        }
        
        //TODO insert to db
        
        return $request->url;
    }
    
    public function getErrorMessage(): ?string
    {
        // TODO: Implement getErrorMessage() method.
    }
}
