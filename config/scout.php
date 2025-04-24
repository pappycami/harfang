<?php

return [
    'driver' => env('SCOUT_DRIVER', 'elasticsearch'),
    'elasticsearch' => [
        'index' => env('ELASTICSEARCH_INDEX', 'harfang'),
        'config' => [
            'hosts' => [
                env('ELASTICSEARCH_HOST', 'localhost:9200'),
            ],
        ],
    ],
];
