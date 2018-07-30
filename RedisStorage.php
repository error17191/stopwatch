<?php

require_once './Storage.php';
require_once './vendor/autoload.php';

class RedisStorage extends Storage
{
    protected $client;

    public function __construct()
    {
        $this->client = new Predis\Client();
    }

    public function restore()
    {
        return [
            $this->client->get('stopwatch:start'),
            $this->client->get('stopwatch:end')
        ];
    }

    public function store($times)
    {
        $this->client->set('stopwatch:start',$times[0]);
        $this->client->set('stopwatch:end',$times[1]);
    }

    public function clear()
    {
        $this->client->del(['stopwatch:start','stopwatch:end']);
    }

}