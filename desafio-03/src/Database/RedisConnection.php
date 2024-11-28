<?php

require 'vendor/autoload.php';

class RedisConnection
{
    private $client;

    public function __construct()
    {
        $this->client = new Predis\Client([
            'scheme' => 'tcp',
            'host' => '127.0.0.1',
            'port' => 6380
        ]);
    }

    public function getClient()
    {
        return $this->client;
    }
}