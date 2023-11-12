<?php

namespace Vaweto\Medium;

use Illuminate\Support\Collection;
use SimpleXMLElement;
use Vaweto\Medium\DataTransferObjects\ArticleData;

class MediumRssReader implements RssReader
{
    protected SimpleXMLElement $xml;

    public Collection $articles;

    public function __construct(string $body)
    {
        try {
            $this->xml = new SimpleXMLElement($body);
        } catch (\Exception $e) {
            throw new \Exception('test'); //Todo throw a custom exception
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
}
