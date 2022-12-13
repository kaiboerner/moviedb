<?php

# basic bootstrapping

namespace KaiBoerner\MovieDb;

use DI\ContainerBuilder;
use Psr\Container\ContainerInterface;

require_once __DIR__ . '/vendor/autoload.php';
require_once __DIR__ . '/config/config.php';

/**
 * Initiallizing Dependency Injection
 */
function getContainer(): ContainerInterface
{
    static $container = null;

    if (null === $container) {
        $containerBuilder = new ContainerBuilder();
        $containerBuilder->addDefinitions(__DIR__ . '/config/php-di.php');
        $container = $containerBuilder->build();

        // register event listeners
        $namespace = "KaiBoerner\\MovieDb\\EventListener";
        foreach (glob(__DIR__ . '/src/EventListener/*.php') as $file) {
            $className = preg_replace('/\\.php$/', '', basename($file));
            $container->get("$namespace\\$className");
        }
    }

    return $container;
}
