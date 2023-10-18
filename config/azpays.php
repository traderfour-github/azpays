<?php

return [
    'prefix' => [
        'micro' => 'azp',
        'full' => 'AzPays'
    ],
    'temporary_token' => [
        'expire_time' => 3
    ],
    'network' => [
        'logo_path' => 'networks/'
    ],
    'merchant' => [
        'logo_path' => 'merchant/',
        'share_domains' => ['trader4.net', 'wordpress.com', 'shopify.com']
    ],
    'gateway' => [
        'logo_path' => 'gateway/'
    ],
    'payment' => [
        'expiration_time' => 60 * 2, // in minutes
        'transfer_deadline' => 10, // in minutes
    ],
    'sms' =>[
        'expired_at' => 3 // Minutes to expire to token
    ],
    'crypto' => [
        'tron' => [
            'network' => 'mainnet',
            'contracts' => [
                'usdt' => 'TR7NHqjeKQxGTCi8q8ZY4pL8otSzgjLj6t',
            ],
            'address' => [
                'prefix' => 'T',
                'length' => 34
            ],
            'trongrid' => [
                'mainnet' => 'https://api.trongrid.io',
                'shasta' => 'https://api.shasta.trongrid.io',
                'nile' => 'https://nile.trongrid.io',
                'key' => '77f427a9-01ad-4bde-8cc5-17d81ba898a5'
            ]
        ]
    ],

    # Discount Configs
    'discount' => [
        'code' => [
            'length' => 6,
            'prefix' => 'AZP',
            'suffix' => '',
        ],
    ],
];
