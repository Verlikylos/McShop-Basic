<?php

return [
    'payment_methods' => [
        'sms' => [
            'displayname' => 'SMS Premium',
            'color' => 'warning'
        ],
        'psc' => [
            'displayname' => 'PaySafeCard',
            'color' => 'danger'
        ],
        'transfer' => [
            'displayname' => 'Przelew',
            'color' => 'primary'
        ],
        'paypal' => [
            'displayname' => 'PayPal',
            'color' => 'info'
        ]
    ],
    'sms_operators' => [
        'cashbill' => 'Cashbill.pl',
        'microsms' => 'MicroSMS.pl',
        'rushpay' => 'RushPay.pl',
        'hotpay' => 'HotPay.pl',
        'simpay' => 'SimPay.pl'
    ]
];
