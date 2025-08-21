<?php

return [
    'default' => env('ELASTIC_CONNECTION', 'default'),
    'connections' => [
        'default' => [
            'hosts' => [
                env('ELASTICSEARCH_HOST', 'localhost:9200'),
            ],
            'basicAuthentication' => [
                'username' => env('ELASTICSEARCH_USERNAME', 'elasticsearch'),
                'password' => env('ELASTICSEARCH_PASSWORD', ''),
            ],
        ],
    ],
];
