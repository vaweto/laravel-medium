<?php

namespace Vaweto\Medium;

use Illuminate\Support\Facades\Http;

class Client
{
    public function get($url): string
    {
        return Http::withToken(config('medium.api_token'))
            ->get(
                $url
            )->body();
    }
}
