<?php

return [

    'driver' => env('NEWSLETTER_DRIVER', 'database'),

    'drivers' => [
        'database' => [
            'connection' => env('DB_CONNECTION', 'mysql'),
            'table' => 'newsletter_subscribers',
        ],
    ],
];
