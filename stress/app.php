<?php

require __DIR__ . '/../vendor/autoload.php';

const MAX_VALUES = 100000;

// Record the start time
$startTime = microtime(true);

// connect to the local redis server
echo("Connecting to redis ...\n");
$client = new Predis\Client('tcp://redis:6379');
$client->connect();

// set lots of value in redis
echo("Setting " . MAX_VALUES . " values ...\n");
for ($i=1; $i<=MAX_VALUES; $i++) {
    $client->set("a_key:{$i}", $i);
}

// get that values randomly
echo("Getting " . MAX_VALUES . " values randomly ...\n");
for ($i=1; $i<=MAX_VALUES; $i++) {
    $key = random_int(1, MAX_VALUES);
    $value = $client->get("a_key:{$key}");
    if(empty($value)) {
        echo("Failed to get value for:{$i}");
    }
}

// Record the end time
$endTime = microtime(true);

// Calculate and print the execution time
$executionTime = $endTime - $startTime;
echo("Execution time: {$executionTime} seconds\n");

