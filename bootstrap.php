<?php

# basic bootstrapping

namespace KaiBoerner\MovieDb;

use DI\ContainerBuilder;
use Psr\Container\ContainerInterface;

require_once __DIR__ . '/vendor/autoload.php';

/**
 * Initiallizing Dependency Injection
 */
function getContainer(): ContainerInterface
{
    static $container = null;

    if (null === $container) {
        $containerBuilder = new ContainerBuilder();
        $containerBuilder->addDefinitions(__DIR__ . '/config/config.php');
        $container = $containerBuilder->build();
    }

    return $container;
}
