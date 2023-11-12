<?php

namespace Vaweto\Medium;

use Illuminate\Support\Collection;
use SimpleXMLElement;
use Vaweto\Medium\DataTransferObjects\ArticleData;
use Vaweto\Medium\RssReader;


class MediumRssReader implements RssReader
{
    protected SimpleXMLElement $xml;

    public Collection $articles;

    public function __construct(String $body)
    {
        try {
            $this->xml = new SimpleXMLElement($body);
        } catch (\Exception $e) {
            throw new \Exception('test'); //Todo throw a custom exception
        }
    }

    /**
     * @return Collection
     */
    public function getArticles(): Collection
    {
        $this->articles = collect();

        foreach ($this->xml->channel->item as $item) {
            $this->articles->push(ArticleData::fromXMLElement($item));
        }

        return $this->articles;
    }
}
