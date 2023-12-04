<?php

namespace Vaweto\Medium;

class TagFeed extends ModelFeed
{
    public function get($name)
    {
        return $this->client->get(
            config('medium.feed_urls.tag').$name
        );
    }
}
