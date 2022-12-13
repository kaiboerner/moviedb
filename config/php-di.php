<?php

namespace KaiBoerner\MovieDb;

# return the config used by php-di
          
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\ORMSetup;
use KaiBoerner\MovieDb\Security\Security;
use KaiBoerner\MovieDb\Security\SecurityInterface;
use KaiBoerner\MovieDb\Templating\TemplateEngine;
use KaiBoerner\MovieDb\Templating\SmartyTemplateEngine;
use Psr\Container\ContainerInterface;
use Smarty;
use function DI\get;

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

    EntityManagerInterface::class => get(EntityManager::class),

    SecurityInterface::class => get(Security::class),

    Smarty::class => function (ContainerInterface $container): Smarty {
        $smarty = new Smarty();
        $smarty->setCompileDir(DIR_TEMPLATES_C);
        $smarty->setTemplateDir(DIR_TEMPLATES);
        $smarty->addPluginsDir(DIR_PLUGINS);

        return $smarty;
    },

    TemplateEngine::class => get(SmartyTemplateEngine::class)
];
