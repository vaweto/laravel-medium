<?php

namespace Vaweto\Medium;

class UserFeed extends ModelFeed
{
    public function get($name)
    {
        return $this->client->get(
            config('medium.feed_urls.user').'@'.$name
        );
    }
}
