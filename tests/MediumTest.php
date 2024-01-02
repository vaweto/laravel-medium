<?php

use Vaweto\Medium\Definitions\MediumFeedType;
use Vaweto\Medium\Medium;
use Vaweto\Medium\Models\MediumFeed;

it('can get a feed per type', function (MediumFeed $feed) {
    $results = (new Medium())->getFeed($feed);

    expect($results->getArticles()->count())->toEqual(10);
})->with([
    fn () => MediumFeed::factory()->create(['name' => 'laravel']),
    fn () => MediumFeed::factory()->create(['name' => 'shaunthornburgh', 'type' => MediumFeedType::USER->value]),
]);

it('can get a feed without model per type', function (string $feed, MediumFeedType $type) {
    $results = (new Medium())->getFeed($feed, $type);

    expect($results->getArticles()->count())->toEqual(10);
})->with([
    ['laravel', MediumFeedType::TAG],
    ['shaunthornburgh', MediumFeedType::USER],
]);

it('can get all feed from collection', function () {
    MediumFeed::factory()->create(['name' => 'laravel']);
    MediumFeed::factory()->create(['name' => 'shaunthornburgh', 'type' => MediumFeedType::USER->value]);
    MediumFeed::factory()->create(['name' => 'php']);

    $results = (new Medium())->all(MediumFeed::all());

    expect($results->count())->toEqual(30);
});
