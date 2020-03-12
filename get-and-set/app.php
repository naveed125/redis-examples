<?php

require __DIR__ . '/../vendor/autoload.php';

// uses Predis
// see https://github.com/nrk/predis
$client = new Predis\Client();

// connect to the local redis server
$client->connect();

// set a value in redis with expiration
$client->setex('a_key', 10, 'a_value');

// get that value back
$value = $client->get('a_key');
echo ("{$value}\n");

// sleep 10 seconds
sleep(10);

// get that value again
$value = $client->get('a_key');
echo ("{$value}\n");
