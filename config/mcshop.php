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
//    'sms_providers' => [
//        'cashbill' => 'Cashbill.pl',
//        'microsms' => 'MicroSMS.pl',
//        'rushpay' => 'RushPay.pl',
//        'hotpay' => 'HotPay.pl',
//        'simpay' => 'SimPay.pl'
//    ],
    'payment_providers' => [
        'sms' => [
            'lvlup' => [
                'name' => 'Lvlup.pro',
                'legal_name' => 'Dotpay Sp. z o.o',
                'class' => App\Payments\Sms\LvlupSmsPayment::class,
                'image' => env('APP_URL') . '/images/dotpay.png',
                'terms' => 'https://www.dotpay.pl/regulamin-serwisow-sms-premium/',
                'complaint' => 'https://www.dotpay.pl/kontakt/uslugi-sms-premium/'
            ],
            'microsms' => [
                'name' => 'MicroSMS.pl',
                'legal_name' => 'MicroSMS',
                'class' => App\Payments\Sms\MicroSmsSmsPayment::class,
                'image' => env('APP_URL') . '/images/microsms.png',
                'terms' => 'https://microsms.pl/partner/documents/',
                'complaint' => 'https://microsms.pl/customer/complaint/'
            ],
            'paybylink' => [
                'name' => 'PayByLink.pl',
                'legal_name' => 'Paybylink',
                'class' => App\Payments\Sms\PaybylinkSmsPayment::class,
                'image' => env('APP_URL') . '/images/paybylink.png',
                'terms' => 'https://paybylink.pl/partner/dokumenty/',
                'complaint' => 'https://paybylink.pl/kontakt/'
            ],
            'hotpay' => [
                'name' => 'HotPay.pl',
                'legal_name' => 'ePłatności Sp. z o.o. Sp. k.',
                'class' => App\Payments\Sms\HoypaySmsPayment::class,
                'image' => env('APP_URL') . '/images/hotpay.png',
                'terms' => 'https://hotpay.pl/umowy-i-regulaminy/',
                'complaint' => 'https://hotpay.pl/reklamacja/'
            ],
        ],
        'psc' => [
            'lvlup' => [
                'name' => 'Lvlup.pro',
                'legal_name' => 'Dotpay Sp. z o.o',
                'class' => App\Payments\Psc\LvlupPscPayment::class,
                'image' => env('APP_URL') . '/images/dotpay.png',
                'terms' => 'https://www.dotpay.pl/regulamin-serwisow-sms-premium/',
                'complaint' => 'https://www.dotpay.pl/kontakt/uslugi-sms-premium/'
            ],
            'paybylink' => [
                'name' => 'PayByLink.pl',
                'legal_name' => 'Paybylink',
                'class' => App\Payments\Psc\Providers\PaybylinkPscPayment::class,
                'image' => env('APP_URL') . '/images/paybylink.png',
                'terms' => 'https://paybylink.pl/partner/dokumenty/',
                'complaint' => 'https://paybylink.pl/kontakt/'
            ],
            'hotpay' => [
                'name' => 'HotPay.pl',
                'legal_name' => 'ePłatności Sp. z o.o. Sp. k.',
                'class' => App\Payments\Psc\Providers\HotpayPscPayment::class,
                'image' => env('APP_URL') . '/images/hotpay.png',
                'terms' => 'https://hotpay.pl/umowy-i-regulaminy/',
                'complaint' => 'https://hotpay.pl/reklamacja/'
            ],
        ]
    ],
    'themes' => [
        'McShop.io',
        'Material Design',
        'Bootstrap Default',
        'Cerulean',
        'Cosmo',
        'Cyborg',
        'Darkly',
        'Flatly',
        'Journal',
        'Litera',
        'Lumen',
        'Lux',
        'Materia',
        'Minty',
        'Pulse',
        'Sandstone',
        'Simplex',
        'Sketchy',
        'Slate',
        'Solar',
        'Spacelab',
        'Superhero',
        'United',
        'Yeti',
    ],
    'log_categories' => [
        'USERS',
        'SERVERS',
        'SERVICES',
        'VOUCHERS',
        'PAGES',
        'NUMBERS',
        'SETTINGS',
        'AUTH'
    ]
];
