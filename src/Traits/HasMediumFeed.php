<?php

namespace Vaweto\Medium\Traits;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Vaweto\Medium\Models\MediumFeed;

trait HasMediumFeed
{
    public function mediumFeeds(): HasMany
    {
        return $this->hasMany(MediumFeed::class);
    }

    public function mediumFeedWithType(?string $type = null): Collection
    {
        return $this->mediumFeeds->filter(fn (MediumFeed $mediumFeed) => $mediumFeed->type === $type);
    }
}
