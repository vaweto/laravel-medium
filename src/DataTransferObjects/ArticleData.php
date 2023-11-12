<?php

namespace Vaweto\Medium\DataTransferObjects;

use Carbon\Carbon;
use Illuminate\Support\Collection;
use SimpleXMLElement;

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

        $pubDate = Carbon::createFromFormat(
            'D, d M Y H:i:s \G\M\T',
            (string)$element->pubDate
        );

        return new self(
            (string)$element->title,
            (string)$element->link,
            (string)$element->guid,
            $categories,
            $pubDate
        );
    }
}
