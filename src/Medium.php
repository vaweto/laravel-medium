<?php

namespace Vaweto\Medium;

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
