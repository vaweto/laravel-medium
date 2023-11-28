<?php

namespace Vaweto\Medium\DataTransferObjects;

use Carbon\Carbon;
use SimpleXMLElement;
use Vaweto\Medium\Helpers\Helpers;

class FeedMetaData
{
    public function __construct(
        public string $title,
        public string $description,
        public string $link,
        public string $imageUrl,
        public Carbon $lastBuildDate
    )
    {}

    /**
     * @param SimpleXMLElement $element
     * @return FeedMetaData
     */
    public static function fromXMLElement(SimpleXMLElement $element): FeedMetaData
    {
        $pubDate = Helpers::formatMediumDate((string)$element->lastBuildDate);

        return new self(
            title: (string)$element->title,
            description: (string)$element->description,
            link: (string)$element->link,
            imageUrl: (string)$element->image->url,
            lastBuildDate: $pubDate
        );
    }
}
