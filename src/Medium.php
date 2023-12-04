<?php

namespace Vaweto\Medium;

use Exception;
use Illuminate\Support\Collection;
use Vaweto\Medium\Exception\InvalidXMLException;

class Medium
{
    public function getUserFeed($user)
    {
        $feed = (new UserFeed())->get($user);

        return new MediumRssReader($feed);
    }

    public function getMultipleUserFeed(...$users)
    {

    }

    public function getTagFeed($tag)
    {
        $feed = (new TagFeed())->get($tag);

        return new MediumRssReader($feed);
    }

    public function getMultipleTagFeed(...$tags): ?Collection
    {
        $tags = collect($tags)->flatten();

        $data = $tags->map(function ($tag) {
            try {
                return $this->getTagFeed($tag)->getArticles();
            } catch (Exception|InvalidXMLException $exception) {
                logger($tag.'is not a valid tag');
            }
        });

        return $data->flatten()->sortByDesc('pubDate')->values();
    }
}
