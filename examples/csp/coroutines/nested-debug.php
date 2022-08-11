#!/usr/bin/env php
<?php

declare(strict_types=1);

/**
 * This script is to help to understand how nested coroutines are executed in order; it works similarly to script
 * "nested.php" under the same directory. Once executed, it prints out "123456789".
 *
 * How to run this script:
 *     docker compose exec -t client bash -c "./csp/coroutines/nested-debug.php"
 */
go(function () {
    echo '1';
    go(function () {
        echo '2';
        co::sleep(3);
        echo '6';
        go(function () {
            echo '7';
            co::sleep(2);
            echo "9\n";
        });
        echo '8';
    });
    echo '3';
    co::sleep(1);
    echo '5';
});
echo '4';

Swoole\Event::wait();
