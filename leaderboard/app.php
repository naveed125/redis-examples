<?php

require __DIR__ . '/../vendor/autoload.php';

// connect to the local redis server
echo("Connecting to redis ...\n");
$client = new Predis\Client('tcp://redis:6379');
$client->connect();

// delete any existing key
echo("Deleting any existing leaderboard ...\n");
$key = 'leaderboard';
$client->del([$key]);

// create a random leaderboard
echo("Creating random entries on the leaderboard ...\n");
for($i=0; $i<20; $i++) {
    $ret = $client->zadd($key, ["player.{$i}" => mt_rand(1, 100)]);
}

// print the top 10
echo("Display the leaderboard data ...\n");
$ret = $client->zrevrange($key, 0, 10, ['withscores' => true]);
print_r($ret);
