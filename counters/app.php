<?php

require __DIR__ . '/../vendor/autoload.php';

// connect to the local redis server
echo("Connecting to redis ...\n");
$client = new Predis\Client('tcp://redis:6379');
$client->connect();

// increment the counter in a loop
for($i=0;$i<10;$i++) {
    $id = $client->incr('counter');
    echo ("Next user id is:{$id}\n");
}
