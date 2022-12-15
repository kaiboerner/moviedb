<?php

namespace KaiBoerner\MovieDb;


/**
 * entry point of the moviedb application
 */
final class Application
{
    private function getActionMethod(string $action): string
    {
        $action = lcfirst(implode('', array_map('ucfirst', preg_split('/[^a-z0-9]/', strtolower($action)))));

        return $action . 'Action';
    }

    public function getController(string $controllerName): object
    {
        return getContainer()->get($this->getControllerClass($controllerName));
    }

    public function getControllerClass(string $controllerName): string
    {
        $controllerName = implode('', array_map('ucfirst', preg_split('/[^a-z0-9]/', strtolower($controllerName))));

        $controllerClass = "\\KaiBoerner\\MovieDb\\Controller\\${controllerName}Controller";

        if (!class_exists($controllerClass)) {
            throw new \Exception("controller NOT FOUND: '$controllerName'");
        }

        return $controllerClass;
    }

    public function redirect(string $controllerName, string $action): void
    {
        $controller = $this->getController($controllerName);
        $method = $this->getActionMethod($action);

        if (!is_callable([$controller, $method])) {
            throw new \Exception("Invalid controller action: '$controllerName', '$action'");
        }

        header("Location: ?controller=$controllerName&action=$action");
        exit();
    }

    public function run(string $controllerName, string $action): void
    {
        $controller = $this->getController($controllerName);
        $method = $this->getActionMethod($action);

        if (!is_callable([$controller, $method])) {
            throw new \Exception("Invalid controller action: '$controllerName', '$action'");
        }

        $controller->$method();

        exit();
    }
}
