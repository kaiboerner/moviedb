<?php

namespace KaiBoerner\MovieDb;

use KaiBoerner\MovieDb\Controller\IndexController;


/**
 * entry point of the moviedb application
 */
final class Application
{
    public function redirect(string $controllerName, string $action): void
    {
        header("Location: ?controller=$controllerName&action=$action");
        exit();
    }

    public function run(string $controllerName, string $action): void
    {
        $controllerName = implode('', array_map('ucfirst', preg_split('/[^a-z0-9]/', strtolower($controllerName))));
        $controller = getContainer()->get("\\KaiBoerner\\MovieDb\\Controller\\${controllerName}Controller");

        $action = lcfirst(implode('', array_map('ucfirst', preg_split('/[^a-z0-9]/', strtolower($action)))));

        $controller->{$action . 'Action'}();
    }
}
