<?php

namespace Vaweto\Medium;

use Vaweto\Medium\Exception\InvalidXMLException;

class Medium
{

    public function getUserFeed($user)
    {
        $feed = (new UserFeed())->get($user);

        return new MediumRssReader($feed);
    }

    public function getMultipleUserFeed(...$data)
    {

    }

    public function getTagFeed($tag)
    {

    }

    public function getMultipleTagFeed(...$data)
    {

    }


}
