<?php

namespace KaiBoerner\MovieDb;

use DI\ContainerBuilder;
use Psr\Container\ContainerInterface;

/**
 * Initiallizing the Dependency Injection container
 */
function getDIContainer(): ContainerInterface
{
    static $container = null;

    if (null === $container) {
        $containerBuilder = new ContainerBuilder();
        $containerBuilder->addDefinitions(DIR_CONFIG . '/php-di.php');
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
