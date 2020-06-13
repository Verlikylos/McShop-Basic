<?php


namespace App\Payments\Sms;


use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Lang;

class LvlupSmsPayment
{
    private $code;
    private $number;
    private $description;
    private $errorMessage;
    private $isValid;
    protected $apiUrl = 'https://lvlup.pro/api/checksms?id=%s&code=%s&number=%s&desc=%s';
    
    public function setCode(string $code): void
    {
        $this->code = $code;
    }
    
    public function setNumber(string $number): void
    {
        $this->number = $number;
    }
    
    public function setDescription(string $description)
    {
        $this->description = $description;
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
        
        $url = sprintf(
            $this->apiUrl,
            setting('settings_payments_lvlup_userid'),
            $this->code,
            $this->number,
            urlencode($this->description)
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
        
        if ($response->valid) {
            $this->isValid = true;
            return;
        }
        
        $this->errorMessage = Lang::get('main.payments.sms.code_invalid');
    
        $this->isValid = false;
    }
}
