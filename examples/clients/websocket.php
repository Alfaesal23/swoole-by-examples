#!/usr/bin/env php
<?php

declare(strict_types=1);

/**
 * In this example we start a WebSocket server on port 9504.
 *
 * How to run this script:
 *     docker compose exec -t client bash -c "./clients/websocket.php"
 */

use Swoole\Coroutine\Http\Client;

Co\run(function () {
    Swoole\Coroutine::create(function () {
        $client = new Client('server', 9504);
        $client->upgrade('/');
        $client->push('Swoole');
        echo $client->recv()->data, "\n";
        $client->close();
    });
});
