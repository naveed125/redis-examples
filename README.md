# Redis Examples
This is companion code for [The Amazing Redis](https://medium.com/swlh/the-amazing-redis-620a621f3b2) blog post.

# How to run
Originally written for the [Redis](https://redis.io), this code can now be used to test some of the redis alternatives as well, it provides a quick test of how much of a drop-in replacements these alternatives are.

```
% docker compose -f redis-compose.yml up -d

% docker exec -it redis-examples-php-1 php get-and-set/app.php
Connecting to redis ...
Setting a value with TTL ...
VALUE: a_value
Getting the value back ...
Sleeping for 10 seconds for the TTL to expire ...
Getting the value again after TTL ...
VALUE:

% docker exec -it redis-examples-php-1 php database/app.php
Connecting to redis ...
Loading user:125 from redis
stdClass Object
(
    [id] => 125
    [name] => test user
    [email] => email@test.com
)

% docker exec -it redis-examples-php-1 php counters/app.php
Connecting to redis ...
Next user id is:1
Next user id is:2
Next user id is:3
Next user id is:4
Next user id is:5
Next user id is:6
Next user id is:7
Next user id is:8
Next user id is:9
Next user id is:10

% docker exec -it redis-examples-php-1 php pub-sub/subscriber.php &
SUB: Connecting to redis ...
SUB: Waiting for messages on channel ...
SUB: Received: hey
SUB: Received: hello

% docker exec -it redis-examples-php-1 php pub-sub/publisher.php
PUB: Connecting to redis ...
PUB: Press CTRL-C to stop.
PUB: Enter a Message:hey
PUB: Sent hey.
PUB: Enter a Message:hello
PUB: Sent hello.

% docker exec -it redis-examples-php-1 php stress/app.php
Connecting to redis ...
Setting 100000 values ...
Getting 100000 values randomly ...
Execution time: 24.030764818192 seconds

```

# What are the alternatives

Here are some of the alternatives I tested with docker. Note that my testing was not comprehensive but did show the use cases from my blog post. In terms of features, no issues
were found as drop-in replacement. If you are trying them side by side, try running `./stress/app.php`

## [ValKey](https://github.com/valkey-io/valkey) [✔️]
* Use valkey-compose.yml
* Great performance.

## [Garnet](https://github.com/microsoft/garnet) [✔️] 
* Use garnet-compose.yml
* Slightly slower performance then redis.

## [KeyDB](https://docs.keydb.dev/) [✔️]
* Use keydb-compose.yml
* Slightly slower performace then Garnet.
