<?php

# basic bootstrapping

namespace KaiBoerner\MovieDb;

use DI\ContainerBuilder;
use Psr\Container\ContainerInterface;

require_once __DIR__ . '/vendor/autoload.php';
require_once __DIR__ . '/config/config.php';

\setlocale(LC_ALL, LOCALE);

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
        foreach (glob(__DIR__ . '/src/EventListener/*.php') as $file) {
            $className = preg_replace('/\\.php$/', '', basename($file));
            $class = new \ReflectionClass("KaiBoerner\\MovieDb\\EventListener\\$className");
            if ($class->isInstantiable()) {
                $container->get($class->getName());
            }
        }
    }

    return $container;
}
