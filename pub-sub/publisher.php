<?php

require __DIR__ . '/../vendor/autoload.php';

// connect to the local redis server
echo("PUB: Connecting to redis ...\n");
$client = new Predis\Client('tcp://redis:6379');
$client->connect();

// Read input from user and send to channel
echo("PUB: Press CTRL-C to stop.\n");
while(true) {
    $message = readline("PUB: Enter a Message:");
    $client->publish('channel', $message);
    echo ("PUB: Sent {$message}.\n");
}
