<?php

require __DIR__ . '/../vendor/autoload.php';

// uses Predis see https://github.com/nrk/predis
$client = new Predis\Client();

// connect to the local redis server
$client->connect();

// Read input from user and send to channel
echo "Press CTRL-C to stop.\n";
while(true) {
    $message = readline("Enter a Message:");
    $client->publish('channel', $message);
    echo ("Sent {$message}.\n");
}
