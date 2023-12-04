<?php

namespace Vaweto\Medium;

Abstract Class ModelFeed
{

    protected Client $client;

    public function __construct()
    {
        $this->client = new Client();
    }

    abstract public function get($name);
}
