<?php

it('can get a user feed', function () {
    $results = (new \Vaweto\Medium\Medium())->getUserFeed('miladev95');

    expect($results->getArticles()->count())->toEqual(10);
});

it('can get a user feed by facade', function () {
    $results = \Vaweto\Medium\Facades\Medium::getUserFeed('miladev95');

    expect($results->getArticles()->count())->toEqual(10);
});

it('can get multiple tag feed', function () {
    $results = (new \Vaweto\Medium\Medium())->getMultipleUserFeed('miladev95', 'shaunthornburgh');

    expect($results->count())->toEqual(20);
});

it('check that articles are order by date', function () {
    $results = (new \Vaweto\Medium\Medium())->getMultipleUserFeed('miladev95', 'shaunthornburgh');

    $results->each(function ($article, $key) use ($results) {
        if ($key + 1 === $results->count()) {
            return;
        }

        expect($article->pubDate->gt($results->get($key + 1)->pubDate))->toBeTrue();
    });

});

it('invalid tag does bypassed', function () {
    $results = (new \Vaweto\Medium\Medium())->getMultipleUserFeed('miladev95', 'test me invalid', 'shaunthornburgh');

    expect($results->count())->toEqual(20);
});
