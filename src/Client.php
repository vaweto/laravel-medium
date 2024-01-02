<?php

namespace Vaweto\Medium;

use Illuminate\Http\Client\HttpClientException;
use Illuminate\Support\Facades\Http;

class Client
{
    /**
     * @throws HttpClientException
     */
    public function get($url): ?string
    {
        $response = Http::withToken(config('medium.api_token'))
            ->get(
                $url
            );

        if ($response->successful()) {
            return $response->body();
        }

        throw new HttpClientException();
    }
}
