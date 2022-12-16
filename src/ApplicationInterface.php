<?php

namespace KaiBoerner\MovieDb;


/**
 * Entry point of the moviedb application.
 * Here is where the routing goes.
 */
interface ApplicationInterface
{
    /**
     * Send a redirect to another controller action.
     * 
     * @param string $controllerName e. g. 'index' for KaiBoerner\MovieDb\Controller\IndexController
     * @param string $action e.g. 'index' for method indexAcion()
     * @return void
     */
    public function redirect(string $controllerName, string $action): void;

    /**
     * Call a controller action and exit.
     * 
     * @param string $controllerName e. g. 'index' for KaiBoerner\MovieDb\Controller\IndexController
     * @param string $action e.g. 'index' for method indexAcion()
     * @return void
     */
    public function run(string $controllerName, string $action): void;
}
