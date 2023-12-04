<?php

it('can get a tag feed', function () {
    $results = (new \Vaweto\Medium\Medium())->getTagFeed('laravel');

    expect($results->getArticles()->count())->toEqual(10);
});

it('can get a tag feed by facade', function () {
    $results = \Vaweto\Medium\Facades\Medium::getTagFeed('laravel');

    expect($results->getArticles()->count())->toEqual(10);
});

it('can get multiple tag feed', function () {
    $results = (new \Vaweto\Medium\Medium())->getMultipleTagFeed('laravel', 'design-patterns');

    expect($results->count())->toEqual(20);
});

it('invalid tag does bypassed', function () {
    $results = (new \Vaweto\Medium\Medium())->getMultipleTagFeed('laravel', 'test me invalid', 'design-patterns');

    expect($results->count())->toEqual(20);
});
