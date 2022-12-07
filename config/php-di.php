<?php

# return the config used by php-di

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\ORMSetup;
use Psr\Container\ContainerInterface;

return [
    EntityManager::class => function (ContainerInterface $container): EntityManagerInterface {
        $paths = [ 'src/Entity' ];
        $isDevMode = 'prod' !== APP_ENV;
        $dbParams = [
            'url'   => DATABASE_DSN
        ];
        $config = ORMSetup::createAttributeMetadataConfiguration($paths, $isDevMode);

        return EntityManager::create($dbParams, $config);

    },

    EntityManagerInterface::class => DI\get(EntityManager::class)
];
