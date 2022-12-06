<?php

namespace KaiBoerner\MovieDb;

use KaiBoerner\MovieDb\Controller\IndexController;


/**
 * entry point of the moviedb application
 */
final class Application
{
    public function run(): void
    {
        $action = empty($_REQUEST['action']) ? 'index' : strtolower($_REQUEST['action']);
        # new_movie should become NewMovie
        $action = implode('', array_map('ucfirst', preg_split('/[^a-z0-9]/', $action)));
        $controller = getContainer()->get("\\KaiBoerner\\MovieDb\\Controller\\${action}Controller");

        $task = empty($_REQUEST['task']) ? 'index' : strtolower($_REQUEST['task']);
        $task = lcfirst(implode('', array_map('ucfirst', preg_split('/[^a-z0-9]/', $task))));

        $controller->{$task . 'Action'}();
    }
}
