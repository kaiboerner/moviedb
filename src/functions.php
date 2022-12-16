<?php

/**
 * require all function files
 */
array_map(
    function (string $file): void { require_once $file; },
     glob(__DIR__ . '/functions/*.php')
);