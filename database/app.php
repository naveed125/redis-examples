<?php

require __DIR__ . '/../vendor/autoload.php';

// uses Predis https://github.com/nrk/predis
use Predis\Client as PredisClient;

$user = get_user(125);
print_r($user);

/**
 * @param $id
 * @return stdClass|null
 */
function get_user($id)
{
    $client = new PredisClient();

    // connect to the local redis server
    $client->connect();

    // check redis
    $key = "user:{$id}";
    $obj = $client->get($key);
    if ($obj) {
        echo ("Loading user:{$id} from redis\n");
        $obj = unserialize($obj);
        return $obj;
    }

    // load from db
    $obj = get_user_from_database($id);
    if (!$obj) {
        echo ("Loading user:{$id} from database\n");
        return null;
    }

    // save in cache before returning
    echo ("Saving user:{$id} in redis\n");
    $client->set($key, serialize($obj));

    // finally return the object to caller
    return $obj;
}

/**
 * Fake database mock
 * @param $id
 * @return stdClass|null
 */
function get_user_from_database($id) {

    $obj = null;
    switch($id)
    {
        case 125:
            $obj = new \stdClass();
            $obj->id = 125;
            $obj->name = "test user";
            $obj->email = "email@test.com";
            break;

        default:
            break;
    }

    return $obj;
}
