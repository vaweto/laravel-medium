<?php

namespace Vaweto\Medium;

abstract class ModelFeed
{
    protected Client $client;

    public function __construct()
    {
        $this->client = new Client();
    }

    abstract public function get($name);
}
