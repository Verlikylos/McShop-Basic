<?php
return [
    'users' => [
        'created' =>
            'Pomyślnie utworzono nowego użytkownika! Dane do logowania:'.
            '<br><br>'.
            'Login: <span class="font-weight-bold">:login</span><br>'.
            'Hasło: <span class="font-weight-bold">:password</span>'
        ,
        'password_reset' =>
            'Pomyślnie zresetowano hasło użytkownika o nazwie <span class="font-weight-bold">:user (ID: #:user_id)</span>!<br>'.
            'Nowe hasło: <span class="font-weight-bold">:password</span>'
        ,
        'cant_reset_password' => 'Nie możesz zresetowac hasła tego użytkownika!',
        'updated' => 'Pomyślnie zaktualizowano ustawienia użytkownika o nazwie <span class="font-weight-bold">:user (ID: #:user_id)</span>!',
        'cant_edit' => 'Nie możesz edytować tego użytkownika!',
        'deleted' => 'Pomyślnie usunięto użytkownika o nazwie <span class="font-weight-bold">:user (ID: #:user_id)</span>!',
        'cant_delete' => 'Nie możesz usunąć tego użytkownika!',
        'logs' => [
            'created' => 'Utworzono nowego użytkownika <span class="font-weight-bold">:user (ID: #:user_id)</span>',
            'password_reset' => 'Zresetowano hasło użytkownika <span class="font-weight-bold">:user (ID: #:user_id)</span>',
            'updated' => 'Zaktualizowano ustawienia użytkownika <span class="font-weight-bold">:user (ID: #:user_id)</span>',
            'deleted' => 'Usunięto użytkownika <span class="font-weight-bold">:user (ID: #:user_id)</span>'
        ]
    ],
    'servers' => [
        'created' => 'Pomyślnie dodano serwer o nazwie <span class="font-weight-bold">:server (ID: #:server_id)</span>!',
        'updated' => 'Pomyślnie zaktualizowano serwer o nazwie <span class="font-weight-bold">:server (ID: #:server_id)</span>!',
        'deleted' => 'Pomyślnie usunięto serwer o nazwie <span class="font-weight-bold">:server (ID: #:server_id)</span>!',
        'announcement' => [
            'edited' => 'Pomyślnie zaktualizowano ogłoszenie serwera o nazwie <span class="font-weight-bold">:server (ID: #:server_id)</span>!',
        ],
        'status' => [
            'enabled' => 'Pomyślnie aktywowano serwer o nazwie <span class="font-weight-bold">:server (ID: #:server_id)</span>!',
            'disabled' => 'Pomyślnie dezaktywowano serwer o nazwie <span class="font-weight-bold">:server (ID: #:server_id)</span>!',
        ],
        'order' => [
            'updated' => 'Pomyślnie zaktualizowano pozycję serwera o nazwie <span class="font-weight-bold">:server (ID: #:server_id)</span>!',
        ],
        'logs' => [
            'created' => 'Dodano serwer <span class="font-weight-bold">:server (ID: #:server_id)</span>',
            'updated' => 'Zaktualizowano serwer <span class="font-weight-bold">:server (ID: #:server_id)</span>',
            'deleted' => 'Usunięto serwer <span class="font-weight-bold">:server (ID: #:server_id)</span>',
            'announcement' => [
                'edited' => 'Zaktualizowano ogłoszenie serwera <span class="font-weight-bold">:server (ID: #:server_id)</span>'
            ],
            'status' => [
                'enabled' => 'Aktywowano serwer <span class="font-weight-bold">:server (ID: #:server_id)</span>',
                'disabled' => 'Dezaktywowano serwer <span class="font-weight-bold">:server (ID: #:server_id)</span>'
            ],
            'order' => [
                'updated' => 'Zaktualizowano pozycję serwera <span class="font-weight-bold">:server (ID: #:server_id)</span>',
            ],
        ]
    ],
    'services' => [
        'created' => 'Pomyślnie dodano usługę o nazwie <span class="font-weight-bold">:service (ID: #:service_id)</span> dla serwera <span class="font-weight-bold">:server (ID: #:server_id)</span>!',
        'updated' => 'Pomyślnie zaktualizowano usługę o nazwie <span class="font-weight-bold">:service (ID: #:service_id)</span> z serwera <span class="font-weight-bold">:server (ID: #:server_id)</span>!',
        'deleted' => 'Pomyślnie usunięto usługę o nazwie <span class="font-weight-bold">:service (ID: #:service_id)</span> z serwera <span class="font-weight-bold">:server (ID: #:server_id)</span>!',
        'status' => [
            'enabled' => 'Pomyślnie aktywowano usługę o nazwie <span class="font-weight-bold">:service (ID: #:service_id)</span> z serwera <span class="font-weight-bold">:server (ID: #:server_id)</span>!',
            'disabled' => 'Pomyślnie dezaktywowano usługę o nazwie <span class="font-weight-bold">:service (ID: #:service_id)</span> z serwera <span class="font-weight-bold">:server (ID: #:server_id)</span>!'
        ],
        'order' => [
            'updated' => 'Pomyślnie zaktualizowano pozycję usługi o nazwie <span class="font-weight-bold">:service (ID: #:service_id)</span> z serwera <span class="font-weight-bold">:server (ID: #:server_id)</span>!'
        ],
        'logs' => [
            'created' => 'Dodano usługę <span class="font-weight-bold">:service (ID: #:service_id)</span> dla serwera <span class="font-weight-bold">:server (ID: #:server_id)</span>!',
            'updated' => 'Zaktualizowano usługę <span class="font-weight-bold">:service (ID: #:service_id)</span> z serwera <span class="font-weight-bold">:server (ID: #:server_id)</span>!',
            'deleted' => 'Usunięto usługę <span class="font-weight-bold">:service (ID: #:service_id)</span> z serwera <span class="font-weight-bold">:server (ID: #:server_id)</span>!',
            'status' => [
                'enabled' => 'Aktywowano usługę <span class="font-weight-bold">:service (ID: #:service_id)</span> z serwera <span class="font-weight-bold">:server (ID: #:server_id)</span>!',
                'disabled' => 'Dezaktywowano usługę <span class="font-weight-bold">:service (ID: #:service_id)</span> z serwera <span class="font-weight-bold">:server (ID: #:server_id)</span>!'
            ],
            'order' => [
                'updated' => 'Zaktualizowano pozycję usługi <span class="font-weight-bold">:service (ID: #:service_id)</span> z serwera <span class="font-weight-bold">:server (ID: #:server_id)</span>!'
            ]
        ]
    ],
    'vouchers' => [
        'created' =>
            '{1} Pomyślnie wygenerowano voucher dla usługi o nazwie <span class="font-weight-bold">:service (ID: #:service_id)</span> z serwera <span class="font-weight-bold">:server (ID: #:server_id)</span>! Jego kod znajduje się poniżej|'.
            '[2,4] Pomyślnie wygenerowano :count vouchery dla usługi o nazwie <span class="font-weight-bold">:service (ID: #:service_id)</span> z serwera <span class="font-weight-bold">:server (ID: #:server_id)</span>! Ich kody znajdują się poniżej.|'.
            '[5,*] Pomyślnie wygenerowano :count voucherów dla usługi o nazwie <span class="font-weight-bold">:service (ID: #:service_id)</span> z serwera <span class="font-weight-bold">:server (ID: #:server_id)</span>! Ich kody znajdują się poniżej.'
        ,
        'deleted' => 'Pomyślnie usunięto voucher dla usługi o nazwie <span class="font-weight-bold">:service (ID: #:service_id)</span> z serwera <span class="font-weight-bold">:server (ID: #:server_id)</span>!',
        'logs' => [
            'created' =>
                '{1} Wygenerowano voucher dla usługi <span class="font-weight-bold">:service (ID: #:service_id)</span> z serwera <span class="font-weight-bold">:server (ID: #:server_id)</span>|'.
                '[2,4] Wygenerowano :count vouchery dla usługi <span class="font-weight-bold">:service (ID: #:service_id)</span> z serwera <span class="font-weight-bold">:server (ID: #:server_id)</span>|'.
                '[5,*] Wygenerowano :count voucherów dla usługi <span class="font-weight-bold">:service (ID: #:service_id)</span> z serwera <span class="font-weight-bold">:server (ID: #:server_id)</span>'
            ,
            'deleted' => 'Usunięto voucher dla usługi <span class="font-weight-bold">:service (ID: #:service_id)</span> z serwera <span class="font-weight-bold">:server (ID: #:server_id)</span>'
        ]
    ],
    'pages' => [
        'created' => 'Pomyślnie dodano stronę o nazwie <span class="font-weight-bold">:page (ID: #:page_id)</span>!',
        'updated' => 'Pomyślnie zaktualizowano stronę o nazwie <span class="font-weight-bold">:page (ID: #:page_id)</span>!',
        'deleted' => 'Pomyślnie usunięto stronę o nazwie <span class="font-weight-bold">:page (ID: #:page_id)</span>!',
        'status' => [
            'enabled' => 'Pomyślnie aktywowano stronę o nazwie <span class="font-weight-bold">:page (ID: #:page_id)</span>!',
            'disabled' => 'Pomyślnie dezaktywowano stronę o nazwie <span class="font-weight-bold">:page (ID: #:page_id)</span>!'
        ],
        'order' => [
            'updated' => 'Pomyślnie zaktualizowano pozycję strony o nazwie <span class="font-weight-bold">:page (ID: #:page_id)</span>!'
        ],
        'logs' => [
            'created' => 'Dodano stronę <span class="font-weight-bold">:page (ID: #:page_id)</span>',
            'updated' => 'Zaktualizowano stronę <span class="font-weight-bold">:page (ID: #:page_id)</span>',
            'deleted' => 'Usunięto stronę <span class="font-weight-bold">:page (ID: #:page_id)</span>',
            'status' => [
                'enabled' => 'Aktywowano stronę <span class="font-weight-bold">:page (ID: #:page_id)</span>',
                'disabled' => 'Dezaktywowano stronę <span class="font-weight-bold">:page (ID: #:page_id)</span>'
            ],
            'order' => [
                'updated' => 'Zaktualizowano pozycję strony <span class="font-weight-bold">:page (ID: #:page_id)</span>'
            ]
        ]
    ],
    'numbers' => [
        'created' => 'Pomyślnie dodano nowy numer <span class="font-weight-bold">:number (ID: #:number_id)</span> dla operatora <span class="font-weight-bold">:provider</span>!',
        'deleted' => 'Pomyśnie usunięto numer <span class="font-weight-bold">:number (ID: #:number_id)</span> obsługiwany przez operatora <span class="font-weight-bold">:provider</span>!',
        'logs' => [
            'created' => 'Dodano numer <span class="font-weight-bold">:number (ID: #:number_id)</span> dla operatora <span class="font-weight-bold">:provider</span>',
            'deleted' => 'Usunięto numer <span class="font-weight-bold">:number (ID: #:number_id)</span> obsługiwany przez operatora <span class="font-weight-bold">:provider</span>'
        ]
    ],
    'logs' => [
        'categories' => [
            'USERS' => 'Użytkownicy ACP',
            'SERVERS' => 'Serwery',
            'SERVICES' => 'Usługi',
            'VOUCHERS' => 'Vouchery',
            'PAGES' => 'Własne strony',
            'NUMBERS' => 'Numery SMS',
            'SETTINGS' => 'Ustawienia strony',
            'AUTH' => 'Logowanie'
        ]
    ],
    'payments' => [
        'no_setup' => 'Przed wykonaniem tej akcji należy skonfigurować ustawienia płatności.'
    ],
    'settings' => [
        'saved' => 'Ustawienia zostały pomyślnie zapisane!',
        'widget' => [
          'teamspeak' => [
              'enabled' => 'Widget <span class="font-weight-bold">Status serwera Teamspeak</span> został aktywowany!',
              'disabled' => 'Widget <span class="font-weight-bold">Status serwera Teamspeak</span> został dezaktywowany!',
          ],
          'discord' => [
              'enabled' => 'Widget <span class="font-weight-bold">Status serwera Discord</span> został aktywowany!',
              'disabled' => 'Widget <span class="font-weight-bold">Status serwera Discord</span> został dezaktywowany!',
          ]
        ],
        'logs' => [
            'general' => 'Zaktualizowano <span class="font-weight-bold">ustawienia ogólne</span>',
            'voucher' => 'Zaktualizowano <span class="font-weight-bold">ustawienia voucherów</span>',
            'layout' => 'Zaktualizowano <span class="font-weight-bold">ustawienia wyglądu</span>',
            'widget' => [
                'teamspeak' => [
                    'updated' => 'Zaktualizowano <span class="font-weight-bold">ustawienia widgetu Teamspeak</span>',
                    'enabled' => 'Aktywowano widget <span class="font-weight-bold">Status serwera Teamspeak</span>',
                    'disabled' => 'Dezaktywowano widget <span class="font-weight-bold">Status serwera Teamspeak</span>',
                ],
                'discord' => [
                    'updated' => 'Zaktualizowano <span class="font-weight-bold">ustawienia widgetu Discord</span>',
                    'enabled' => 'Aktywowano widget <span class="font-weight-bold">Status serwera Discord</span>',
                    'disabled' => 'Dezaktywowano widget <span class="font-weight-bold">Status serwera Discord</span>',
                ]
            ],
            'payments' => [
                'general' => 'Zaktualizowano <span class="font-weight-bold">ustawienia płatności</span>',
                'provider' => 'Zaktualizowano <span class="font-weight-bold">ustawienia płatności :provider</span>',
            ]
        ]
    ]
];
