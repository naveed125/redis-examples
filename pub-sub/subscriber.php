<?php

require __DIR__ . '/../vendor/autoload.php';

// connect to the local redis server
echo("SUB: Connecting to redis ...\n");
$client = new Predis\Client('tcp://redis:6379');
$client->connect();

// wait for messages on channel and print them on screen
echo("SUB: Waiting for messages on channel ...\n");
$loop = $client->pubSubLoop();
$loop->subscribe("channel");
foreach($loop as $message) {
    if($message->kind == "message") {
        echo("SUB: Received: {$message->payload}\n");
    }
}
