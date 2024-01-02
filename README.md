# This package helps to fetch a recent feed for users and tags of a medium.com

[![Latest Version on Packagist](https://img.shields.io/packagist/v/vaweto/laravel-medium.svg?style=flat-square)](https://packagist.org/packages/vaweto/laravel-medium)
[![GitHub Tests Action Status](https://img.shields.io/github/actions/workflow/status/vaweto/laravel-medium/run-tests.yml?branch=main&label=tests&style=flat-square)](https://github.com/vaweto/laravel-medium/actions?query=workflow%3Arun-tests+branch%3Amain)
[![GitHub Code Style Action Status](https://img.shields.io/github/actions/workflow/status/vaweto/laravel-medium/fix-php-code-style-issues.yml?branch=main&label=code%20style&style=flat-square)](https://github.com/vaweto/laravel-medium/actions?query=workflow%3A"Fix+PHP+code+style+issues"+branch%3Amain)
[![Total Downloads](https://img.shields.io/packagist/dt/vaweto/laravel-medium.svg?style=flat-square)](https://packagist.org/packages/vaweto/laravel-medium)

With this package you can get the rss feed of any valid Medium tag or user you want as objects in order to make a feed on you application. You can use your database to store the feeds you want to watch or you can call them hardcoded by specify the name of the feed and the type of the feed (user or tag).

Here's a quick example:
## Usage

Get a specific feed hardcoded
```php
use Vaweto\Medium\Facades\Medium;
use Vaweto\Medium\Definitions\MediumFeedType;

$articles = Medium::getFeed('laravel', MediumFeedType::TAG)->getArticles();

```

Get a specific feed from database
```php
use Vaweto\Medium\Facades\Medium;
use Vaweto\Medium\Models\MediumFeed;

$mediumFeed = MediumFeed::query()->first();
$articles = Medium::getFeed(mediumFeed)->getArticles();

```

Get a multiple feeds from database 
```php
use Vaweto\Medium\Facades\Medium;
use Vaweto\Medium\Models\MediumFeed;

$mediumFeeds = MediumFeed::query()->all();
$articles = Medium::all(mediumFeeds);

```

Use it in your controller
```php
use Vaweto\Medium\Facades\Medium;
use Vaweto\Medium\Models\MediumFeed;

class MediumFeedControllerController
{
    public function __invoke(Invoice $invoice)
    {
        $articles = Medium::all(MediumFeed::query()->all());

        return view('your-feed-blade', compact('articles'));
    }
}

```

And on your blade
```php
@foreach ($articles as $article)
    <div>
        <h2>{{ $article->title }}</h2>
        <p>{{ $article->pubDate->toDateTimeString() }}</p>
        <a href="{{ $article->guid }}" target="_blank">Read More</a>
    </div>
@endforeach
```

## Installation

You can install the package via composer:

```bash
composer require vaweto/laravel-medium
```

You can publish and run the migrations with:

```bash
php artisan vendor:publish --tag="medium-migrations"
php artisan migrate
```

You can publish the config file with:

```bash
php artisan vendor:publish --tag="medium-config"
```

This is the contents of the published config file:

```php
return [
    'api_token' => env('MEDIUM_API_TOKEN'),
    'feed_urls' => [
        'user' => 'https://medium.com/feed/',
        'tag' => 'https://medium.com/feed/tag/',
    ],
    'caching' => [
        'enabled' => env('MEDIUM_CACHING', false),
        'time_in_seconds' => env('MEDIUM_CACHING_TIME_IN_SECONDS', 120),
    ],
];
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

## Security Vulnerabilities

Please review [our security policy](../../security/policy) on how to report security vulnerabilities.

## Credits

- [Vagelis Bismpikis](https://github.com/vaweto)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
