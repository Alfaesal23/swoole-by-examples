#!/usr/bin/env php
<?php

/**
 * In this example we create a Redis connection pool with a maximum number of connections of 64 (the default pool size).
 * We then repeatedly get a connection from the pool, execute a Redis set and Redis get command, and put back the
 * connection.
 *
 * The connection pool classes (\Swoole\Database\RedisConfig and \Swoole\Database\RedisPool in this example) are
 * built-in classes in Swoole since 4.4.13+.
 *
 * You can use following command to run this script:
 *     docker exec -t $(docker ps -qf "name=client") bash -c "./pool/database-pool/redis.php"
 */

use Swoole\Coroutine\System;
use Swoole\Database\RedisConfig;
use Swoole\Database\RedisPool;

co\run(function () {
    $pool = new RedisPool((new RedisConfig())->withHost(System::gethostbyname("server")));
    for ($n = 1024; $n--;) {
        go(function () use ($pool) {
            $redis = $pool->get();
            $result = $redis->set("foo", "bar");
            if (!$result) {
                throw new Exception("failed to set a value in Redis.");
            }
            $result = $redis->get("foo");
            if ("bar" != $result) {
                throw new Exception("failed to get data from Redis.");
            }
            $pool->put($redis);
        });
    }
});
