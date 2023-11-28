<?php

namespace Vaweto\Medium;

use GuzzleHttp\Promise\PromiseInterface;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;

class Client
{
    /**
     * @param $url
     * @return string
     */
    public function get($url): string
    {
        return Http::withToken(config('medium.api_token'))
            ->get(
                $url
            )->body();
    }
}
