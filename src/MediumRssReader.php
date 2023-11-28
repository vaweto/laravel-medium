<?php

namespace Vaweto\Medium;

use Exception;
use Illuminate\Support\Collection;
use SimpleXMLElement;
use Vaweto\Medium\DataTransferObjects\ArticleData;
use Vaweto\Medium\DataTransferObjects\FeedMetaData;
use Vaweto\Medium\Exception\InvalidXMLException;

class MediumRssReader implements RssReader
{
    private SimpleXMLElement $xml;

    protected Collection $articles;

    public function __construct(string $body)
    {
        try {
            $this->xml = new SimpleXMLElement($body);
        } catch (Exception $e) {
            throw new InvalidXMLException(message: 'The string is not a valid xml');
        }
    }

    public function getArticles(): Collection
    {
        $this->articles = collect();

        foreach ($this->xml->channel->item as $item) {
            $this->articles->push(ArticleData::fromXMLElement($item));
        }

        return $this->articles;
    }

    public function getMetaDetails(): FeedMetaData
    {
        return FeedMetaData::fromXMLElement($this->xml->channel);
    }
}
