<?php

require __DIR__ . '/../vendor/autoload.php';

// uses Predis see https://github.com/nrk/predis
$client = new Predis\Client();

// connect to the local redis server
$client->connect();

// wait for messages on channel and print them on screen
echo("Waiting for messages on channel.\n");
$loop = $client->pubSubLoop();
$loop->subscribe("channel");
foreach($loop as $message) {
    if($message->kind == "message") {
        echo("Received: {$message->payload}\n");
    }
}
