<?php

require __DIR__ . '/../vendor/autoload.php';

// uses Predis
// see https://github.com/nrk/predis
$client = new Predis\Client();

// connect to the local redis server
$client->connect();

// delete any existing key
$key = 'leaderboard';
$client->del([$key]);

// create a random leaderboard
for($i=0; $i<20; $i++)
{
    $ret = $client->zadd($key, ["player.{$i}" => mt_rand(1, 100)]);
}

// print the top 10
$ret = $client->zrevrange($key, 0, 10, ['withscores' => true]);
print_r($ret);

