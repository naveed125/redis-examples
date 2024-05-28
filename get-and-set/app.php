<?php

require __DIR__ . '/../vendor/autoload.php';

// connect to the local redis server
echo("Connecting to redis ...\n");
$client = new Predis\Client('tcp://redis:6379');
$client->connect();

// set a value in redis with expiration
echo("Setting a value with TTL ...\n");
$client->setex('a_key', 10, 'a_value');

// get that value back
echo("Getting the value back ...\n");
$value = $client->get('a_key');
echo ("VALUE: {$value}\n");

// sleep 10 seconds
echo("Sleeping for 10 seconds for the TTL to expire ...\n");
sleep(10);

// get that value again
echo("Getting the value again after TTL ...\n");
$value = $client->get('a_key');
echo("VALUE: {$value}\n");
