<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;

class RecognizePaymentGatewayTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function testExample()
    {
        $paymentType = 'psc';
        $paymentGatewayProvider = 'paybylink';
        $request = [
            'playerName' => 'Verlikylos',
            'service_id' => 1,
            'paymentType' => $paymentType
        ];
        
        $paymentGateway = PaymentManager::getPaymentGateway($request);
    }
}
