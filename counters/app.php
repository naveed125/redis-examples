<?php

require __DIR__ . '/../vendor/autoload.php';

// uses Predis
// see https://github.com/nrk/predis
$client = new Predis\Client();

// connect to the local redis server
$client->connect();

// increment the counter in a loop
for($i=0;$i<10;$i++) {
    $id = $client->incr('counter');
    echo ("Next user id is:{$id}\n");
}
