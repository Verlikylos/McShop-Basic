<?php


namespace App\Payments\Sms;


use App\Models\Service;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Lang;

class MicroSmsSmsPayment implements SmsPayment
{
    private $code;
    private $number;
    private $errorMessage;
    private $isValid;
    protected $apiUrl = 'http://microsms.pl/api/v2/index.php?userid=%s&number=%s&code=%s&serviceid=%s';
    
    public function setCode(string $code): void
    {
        $this->code = $code;
    }
    
    public function setNumber(string $number): void
    {
        $this->number = $number;
    }
    
    public function isCodeValid(): bool
    {
        if ($this->isValid == null) {
            $this->verifyCode();
        }
        
        return $this->isValid;
    }
    
    public function getErrorMessage(): string
    {
        return $this->errorMessage;
    }
    
    protected function verifyCode(): void {
        echo $this->apiUrl;
        
        $this->isValid = true;
        return;
        
        $url = sprintf(
            $this->apiUrl,
            setting('settings_payments_microsms_userid'),
            $this->number,
            $this->code,
            setting('settings_payments_microsms_sms_serviceid')
        );
    
        $response = Http::get($url);
    
        if (!$response->ok()) {
            $this->errorMessage = Lang::get('main.payments.general_error');
        
            $this->isValid = false;
            return;
        }
    
        $response = $response->object();
    
        if (!is_object($response)) {
            $this->errorMessage = Lang::get('main.payments.general_error');
    
            $this->isValid = false;
            return;
        }
    
        if (isset($response->error) && $response->error) {
            $this->errorMessage = Lang::get('main.payments.general_error');
    
            $this->isValid = false;
            return;
        }
    
        if (!$response->connect) {
            $this->errorMessage = Lang::get('main.payments.general_error');
    
            $this->isValid = false;
            return;
        }
    
        if (!$response->data->status) {
            $this->errorMessage = Lang::get('main.payments.sms.code_invalid');
    
            $this->isValid = false;
            return;
        }
    
        $this->isValid = true;
    }
}
