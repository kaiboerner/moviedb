<?php

/** 
 *  return the config used by php-di
 */

namespace KaiBoerner\MovieDb;

          
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\ORMSetup;
use KaiBoerner\MovieDb\{Application, ApplicationInterface};
use KaiBoerner\MovieDb\Security\{Security, SecurityInterface};
use KaiBoerner\MovieDb\Templating\{SmartyTemplating, TemplatingInterface};
use KaiBoerner\MovieDb\Util\{MessageQueueInterface, SessionMessageQueue};
use Smarty;

use function DI\get;

return [
    ApplicationInterface::class => get(Application::class),
    
    EntityManager::class => function (): EntityManagerInterface {
        $paths = [ 'src/Entity' ];
        $isDevMode = 'prod' !== APP_ENV;
        $dbParams = [
            'url'   => DATABASE_DSN
        ];
        $config = ORMSetup::createAttributeMetadataConfiguration($paths, $isDevMode);

        return EntityManager::create($dbParams, $config);
    },

    EntityManagerInterface::class => get(EntityManager::class),

    MessageQueueInterface::class => get(SessionMessageQueue::class),

    SecurityInterface::class => get(Security::class),

    Smarty::class => function (): Smarty {
        $smarty = new Smarty();
        $smarty->setCompileDir(DIR_TEMPLATES_C);
        $smarty->setTemplateDir(DIR_TEMPLATES);
        $smarty->addPluginsDir(DIR_PLUGINS);

        return $smarty;
    },

    TemplatingInterface::class => get(SmartyTemplating::class)
];
