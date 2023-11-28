<?php

namespace Vaweto\Medium\DataTransferObjects;

use Carbon\Carbon;
use Illuminate\Support\Collection;
use SimpleXMLElement;
use Vaweto\Medium\Helpers\Helpers;

class ArticleData
{
    public function __construct(
        public string $title,
        public string $link,
        public string $guid,
        public Collection $categories,
        public Carbon $pubDate
    )
    {}

    /**
     * @param SimpleXMLElement $element
     * @return ArticleData
     */
    public static function fromXMLElement(SimpleXMLElement $element): ArticleData
    {
        $categories = collect();

        foreach ($element->category as $category) {
            $categories->push($category);
        }

        $pubDate = Helpers::formatMediumDate((string)$element->pubDate);

        return new self(
            title: (string)$element->title,
            link: (string)$element->link,
            guid: (string)$element->guid,
            categories: $categories,
            pubDate: $pubDate
        );
    }
}
