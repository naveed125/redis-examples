<?php

require __DIR__ . '/../vendor/autoload.php';

use Predis\Client as PredisClient;


// connect to the local redis server
echo("Connecting to redis ...\n");
$client = new Predis\Client('tcp://redis:6379');
$client->connect();

// synchronized code block
$key = 'lock';
echo("Acquiring lock ...\n");
if(getLock($client, $key)) {
    echo "Lock acquired\n";

    // do something useful here
    echo("Sleeping for a bit ...\n");
    sleep(1);

    // release the lock
    echo("Releasing the lock ...\n");
    $client->del([$key]);
}
else {
    echo("Failed to acquire lock.\n");
}

/**
 * Acquire a lock, notice use of NX parameter
 * @param PredisClient $client
 * @param string $key
 * @return bool
 */
function getLock(PredisClient $client, $key)
{
    // attempts to acquire a lock and 
    for ($i = 0; $i < 3; $i++) {

        // Set with TTL = 3 and fails if already set (NX)
        $lock = $client->set($key, time(), 'EX', 3, 'NX');
        if ($lock) {
            return true;
        }

        // use exponential back-off when retrying
        usleep(100 * ($i + 1));
    }

    return false;
}
