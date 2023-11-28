<?php

namespace Vaweto\Medium;

use Illuminate\Support\Facades\Http;

class UserFeed
{
    private Client $client;

    public function __construct()
    {
        $this->client = new Client();
    }

    public function get($name) {
        return $this->client->get(
            config('medium.feed_urls.user') . '@' .$name
        );
    }

}
