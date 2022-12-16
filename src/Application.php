<?php

namespace KaiBoerner\MovieDb;

use Psr\Container\ContainerInterface;

/**
 * {@inheritDoc}
 */
final class Application implements ApplicationInterface
{
    public function __construct(private ContainerInterface $container)
    {}

    private function getActionMethod(string $action): string
    {
        $action = lcfirst(implode('', array_map('ucfirst', preg_split('/[^a-z0-9]/', strtolower($action)))));

        return $action . 'Action';
    }

    private function getController(string $controllerName): object
    {
        return $this->container->get($this->getControllerClass($controllerName));
    }

    private function getControllerClass(string $controllerName): string
    {
        $controllerName = implode('', array_map('ucfirst', preg_split('/[^a-z0-9]/', strtolower($controllerName))));

        $controllerClass = "\\KaiBoerner\\MovieDb\\Controller\\${controllerName}Controller";

        if (!class_exists($controllerClass)) {
            throw new \Exception("controller NOT FOUND: '$controllerName'");
        }

        return $controllerClass;
    }

    /**
     * {@inheritDoc}
     */
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

    /**
     * {@inheritDoc}
     */
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
