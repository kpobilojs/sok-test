<?php

namespace Core;

use Exception;
use RuntimeException;

class Router
{
    /** @var array */
    protected $routes = [];
    /** @var array */
    protected $params = [];

    /**
     * @param string $route
     * @param array $params Parameters (controller, action, etc.)
     * @return void
     */
    public function add(string $route, $params = []): void
    {
        $this->routes[$route] = $params;
    }

    /**
     * @return array
     */
    public function getRoutes(): array
    {
        return $this->routes;
    }

    /**
     * @param string $url
     * @return boolean
     */
    public function match(string $url): bool
    {
        foreach ($this->routes as $route => $params) {
            if ($route === $url) {
                $this->params = $params;

                return true;
            }
        }

        return false;
    }

    /**
     * @return array
     */
    public function getParams(): array
    {
        return $this->params;
    }

    /**
     * Dispatch the route, creating the controller object and running the action method
     *
     * @param string $url The route URL
     *
     * @return void
     * @throws Exception
     */
    public function dispatch(string $url): void
    {

        $url = $this->getCleanUrl($url);

        if ($this->match($url)) {
            $controller = $this->params['controller'];
            $controller = $this->convertToStudlyCaps($controller);
            $controller = $this->getNamespace() . $controller;

            if (class_exists($controller)) {
                $controller_object = new $controller($this->params);

                $action = $this->params['action'];
                $action = $this->convertToCamelCase($action);

                if (preg_match('/action$/i', $action) === 0) {
                    $controller_object->$action();

                } else {
                    throw new RuntimeException("Method $action in controller $controller cannot be called directly - remove the Action suffix to call this method");
                }
            } else {
                throw new RuntimeException("Controller class $controller not found");
            }
        } else {
            throw new RuntimeException('No route matched.', 404);
        }
    }

    /**
     * Convert the string with hyphens to StudlyCaps,
     * e.g. post-authors => PostAuthors
     *
     * @param string $string The string to convert
     *
     * @return string
     */
    protected function convertToStudlyCaps(string $string): string
    {
        return str_replace(' ', '', ucwords(str_replace('-', ' ', $string)));
    }

    /**
     * Convert the string with hyphens to camelCase,
     * e.g. add-new => addNew
     *
     * @param string $string The string to convert
     *
     * @return string
     */
    protected function convertToCamelCase(string $string): string
    {
        return lcfirst($this->convertToStudlyCaps($string));
    }

    /**
     * @param string $url
     * @return string
     */
    protected function getCleanUrl(string $url): string
    {
        if ($url !== '') {
            $parts = explode('?', $url);

            return $parts[0];
        }

        return $url;
    }

    /**
     * Get the namespace for the controller class. The namespace defined in the
     * route parameters is added if present.
     *
     * @return string The request URL
     */
    protected function getNamespace(): string
    {
        $namespace = 'App\Controllers\\';

        if (array_key_exists('namespace', $this->params)) {
            $namespace .= $this->params['namespace'] . '\\';
        }

        return $namespace;
    }
}
