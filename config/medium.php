<?php

// config for Vaweto/Medium
return [
    'api_token' => env('MEDIUM_API_TOKEN'),
    'feed_urls' => [
        'user' => 'https://medium.com/feed/',
        'tag' => 'https://medium.com/feed/tag/',
    ],
    'caching' => [
        'enabled' => env('MEDIUM_CACHING', false),
        'time_in_seconds' => env('MEDIUM_CACHING_TIME_IN_SECONDS', 120),
    ],
];
