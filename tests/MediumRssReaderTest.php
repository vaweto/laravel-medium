<?php

use Vaweto\Medium\DataTransferObjects\ArticleData;
use Vaweto\Medium\MediumRssReader;

it('can get articles from an user feed xml', function () {
    $content = file_get_contents(__DIR__ .'/xml/test.xml');
    $reader = new MediumRssReader($content);

    expect($reader->getArticles()->count())->toEqual(10);
});

it('can get articles from an tag feed xml ', function () {
    $content = file_get_contents(__DIR__ .'/xml/tag.xml');
    $reader = new MediumRssReader($content);

    expect($reader->getArticles()->count())->toEqual(10);
});

it('it return a collection of ArticleData objects', function () {
    $content = file_get_contents(__DIR__ .'/xml/test.xml');
    $reader = new MediumRssReader($content);

    expect(
       $reader->getArticles()
    )->toContainOnlyInstancesOf(ArticleData::class);
});

it('can get articles title from an xml', function () {
    $content = file_get_contents(__DIR__ .'/xml/test.xml');
    $reader = new MediumRssReader($content);

    $article = $reader->getArticles()->first();

    expect($article->title)->toEqual("Mastering Eloquent: An In-Depth Guide to Laravel Accessors and Mutators");
});

it('can get articles link from an xml', function () {
    $content = file_get_contents(__DIR__ .'/xml/test.xml');
    $reader = new MediumRssReader($content);

    $article = $reader->getArticles()->first();

    expect($article->link)
        ->toBeUrl()
        ->and($article->link)
        ->toEqual("https://medium.com/@miladev95/mastering-eloquent-an-in-depth-guide-to-laravel-accessors-and-mutators-65bd7d9dfabc?source=rss-567b1067f520------2");
});

it('can get articles guid from an xml', function () {
    $content = file_get_contents(__DIR__ .'/xml/test.xml');
    $reader = new MediumRssReader($content);

    $article = $reader->getArticles()->first();

    expect($article->guid)
        ->toBeUrl()
        ->toEqual("https://medium.com/p/65bd7d9dfabc");
});


it('can get articles published date from an xml', function () {
    $content = file_get_contents(__DIR__ .'/xml/test.xml');
    $reader = new MediumRssReader($content);

    $article = $reader->getArticles()->first();

    expect($article->pubDate)
        ->toBeInstanceOf(\Carbon\Carbon::class)
        ->toEqual("2023-10-25 15:12:25");
});

it('can get meta feed title from an xml', function () {
    $content = file_get_contents(__DIR__ .'/xml/tag.xml');
    $reader = new MediumRssReader($content);

    $meta = $reader->getMetaDetails();

    expect($meta->title)
        ->toEqual("Laravel on Medium");
});

it('can get meta user profile title from an xml', function () {
    $content = file_get_contents(__DIR__ .'/xml/test.xml');
    $reader = new MediumRssReader($content);

    $meta = $reader->getMetaDetails();

    expect($meta->title)
        ->toEqual("Stories by Miladev95 on Medium");
});

it('can get meta feed description from an xml', function () {
    $content = file_get_contents(__DIR__ .'/xml/tag.xml');
    $reader = new MediumRssReader($content);

    $meta = $reader->getMetaDetails();

    expect($meta->description)
        ->toEqual("Latest stories tagged with Laravel on Medium");
});

it('can get meta feed link from an xml', function () {
    $content = file_get_contents(__DIR__ .'/xml/tag.xml');
    $reader = new MediumRssReader($content);

    $meta = $reader->getMetaDetails();

    expect($meta->link)
        ->toEqual("https://medium.com/tag/laravel/latest?source=rss------laravel-5");
});

it('can get meta feed imageurl from an xml', function () {
    $content = file_get_contents(__DIR__ .'/xml/tag.xml');
    $reader = new MediumRssReader($content);

    $meta = $reader->getMetaDetails();

    expect($meta->imageUrl)
        ->toEqual("https://cdn-images-1.medium.com/proxy/1*TGH72Nnw24QL3iV9IOm4VA.png");
});

it('can get meta feed last published date from an xml', function () {
    $content = file_get_contents(__DIR__ .'/xml/tag.xml');
    $reader = new MediumRssReader($content);

    $meta = $reader->getMetaDetails();

    expect($meta->lastBuildDate->toDateString())
        ->toEqual("2023-11-28");
});
