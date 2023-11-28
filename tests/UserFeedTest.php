<?php

it('can get a user feed', function () {
    $results = (new \Vaweto\Medium\Medium())->getUserFeed('miladev95');

    expect($results->getArticles()->count())->toEqual(10);
});

it('can get a user feed by facade', function () {
    $results = \Vaweto\Medium\Facades\Medium::getUserFeed('miladev95');

    expect($results->getArticles()->count())->toEqual(10);
});
