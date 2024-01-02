<?php

namespace Vaweto\Medium;

use Exception;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;
use Vaweto\Medium\Definitions\MediumFeedType;
use Vaweto\Medium\Exception\InvalidFeedTypeException;
use Vaweto\Medium\Exception\InvalidXMLException;
use Vaweto\Medium\Models\MediumFeed;

class Medium
{
    public function all(Collection $feeds): ?Collection
    {
        $data = $feeds->map(function ($feed) {
            try {
                return $this->getFeed($feed, MediumFeedType::from($feed->type))->getArticles();
            } catch (Exception|InvalidXMLException $exception) {
                logger($feed.'is not a valid tag');
            }
        });

        return $data->flatten()->reject(fn ($item) => is_null($item))->sortByDesc('pubDate')->values();
    }

    public function getFeed(MediumFeed|string $feed, ?MediumFeedType $type = null): MediumRssReader
    {
        if ($feed instanceof MediumFeed) {
            return $this->getFeedByType($feed->name, $feed->type);
        }

        return $this->getFeedByType($feed, $type->value);
    }

    public function getUserFeed($user): MediumRssReader
    {
        if (config('medium.caching.enabled')) {
            $feed = Cache::remember('user-'.$user, config('medium.caching.time_in_second'), function () use ($user) {
                return (new UserFeed())->get($user);
            });
        } else {
            $feed = (new UserFeed())->get($user);
        }

        return new MediumRssReader($feed);
    }

    public function getMultipleUserFeed(...$users): ?Collection
    {
        $users = collect($users)->flatten();

        $data = $users->map(function ($user) {
            try {
                return $this->getUserFeed($user)->getArticles();
            } catch (Exception|InvalidXMLException $exception) {
                logger($user.'is not a valid tag');
            }
        });

        return $data->flatten()->reject(fn ($item) => is_null($item))->sortByDesc('pubDate')->values();
    }

    public function getTagFeed($tag): MediumRssReader
    {
        if (config('medium.caching.enabled')) {
            $feed = Cache::remember('tag-'.$tag, config('medium.caching.time_in_second'), function () use ($tag) {
                return (new TagFeed())->get($tag);
            });
        } else {
            $feed = (new TagFeed())->get($tag);
        }

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

        return $data->flatten()->reject(fn ($item) => is_null($item))->sortByDesc('pubDate')->values();
    }

    /**
     * @throws InvalidFeedTypeException
     */
    public function getFeedByType(string $name, string $type): MediumRssReader
    {
        return match ($type) {
            MediumFeedType::TAG->value => $this->getTagFeed($name),
            MediumFeedType::USER->value => $this->getUserFeed($name),
            default => throw new InvalidFeedTypeException()
        };
    }
}
