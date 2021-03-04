<?php

return [
    'server' => [
        'not_active' => 'Sklep tego serwera nie jest widoczny dla użytkowników, ponieważ nie został on aktywowany. Widzisz go ponieważ jesteś zalogowanym użytkownikiem. Serwer możesz aktywować w :link panelu administratora :endlink!'
    ],
    'service' => [
        'not_active' => 'Ta usługa nie jest widoczna dla użytkowników, ponieważ nie została ona aktywowana. Widzisz ją ponieważ jesteś zalogowanym użytkownikiem. Usługę możesz aktywować w :link panelu administratora :endlink!'
    ],
    'page' => [
        'not_active' => 'Ta strona nie jest widoczna dla użytkowników, ponieważ nie została ona aktywowana. Widzisz ją ponieważ jesteś zalogowanym użytkownikiem. Stronę możesz aktywować w :link panelu administratora :endlink!'
    ],
    'payments' => [
        'general_error' => 'Wystąpił błąd podczas realizacji płatności. Spróbuj ponownie później lub skontaktuj się z administracją.',
        'sms' => [
            'code_invalid' => 'Podany kod jest nieprawidłowy lub został już użyty!'
        ],
        'completed' => 'Płatność przebiegła pomyślnie. Usługa <span class="font-weight-bold">:service</span> została przekazana do realizacji.',
        'payment_title' => 'Usługa :service z serwera :server na :page_title'
    ],
];
