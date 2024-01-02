<?php

namespace Vaweto\Medium;

use Illuminate\Http\Client\HttpClientException;
use phpDocumentor\Reflection\Types\Collection;

class UserFeed extends ModelFeed
{
    public function get($name)
    {
        return $this->client->get(
            config('medium.feed_urls.user').'@'.$name
        );
    }
}
