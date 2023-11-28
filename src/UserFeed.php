<?php

namespace Vaweto\Medium;

class UserFeed
{
    private Client $client;

    public function __construct()
    {
        $this->client = new Client();
    }

    public function get($name)
    {
        return $this->client->get(
            config('medium.feed_urls.user').'@'.$name
        );
    }
}
