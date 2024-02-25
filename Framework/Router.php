<?php

namespace JWord\Framework;

use JWord\App\Controllers\ErrorController;

class Router
{
    protected $routes = [];

    /**
     * Method to register a route
     *
     * @param string $method
     * @param string $uri
     * @param string $action
     * 
     * @return void
     * 
     */
    public function register_route(string $method, string $uri, string $action): void
    {
        list($controller, $controller_method) = explode('@', $action);

        $this->routes[] = [
            'method' => $method,
            'uri' => $uri,
            'controller' => $controller,
            'controller_method' => $controller_method,
        ];
    }

    /**
     * Get route
     *
     * @param string $uri
     * @param string $method
     * 
     * @return void
     * 
     */
    public function get(string $uri, string $controller): void
    {
        $this->register_route('GET', $uri, $controller);
    }

    /**
     * Post route
     *
     * @param string $uri
     * @param string $method
     * 
     * @return void
     * 
     */
    public function post(string $uri, string $controller): void
    {
        $this->register_route('POST', $uri, $controller);
    }

    /**
     * put route
     *
     * @param string $uri
     * @param string $method
     * 
     * @return void
     * 
     */
    public function put(string $uri, string $controller): void
    {
        $this->register_route('PUT', $uri, $controller);
    }

    /**
     * delete route
     *
     * @param string $uri
     * @param string $method
     * 
     * @return void
     * 
     */
    public function delete(string $uri, string $controller): void
    {
        $this->register_route('DELETE', $uri, $controller);
    }

    /**
     * Route the request
     *
     * @param string $uri
     * @param string $method
     * 
     * @return void
     * 
     */
    public function route(string $uri, string $method): void
    {
        foreach ($this->routes as $route) {
            if ($route['uri'] === $uri && $route['method'] === $method) {

                // Extract controller and controller method
                $controller = 'JWord\\App\\Controllers\\' . $route['controller'];
                $controller_method = $route['controller_method'];

                // Instantiate the controller and call the method
                $controller_inst = new $controller();
                $controller_inst->$controller_method();

                return;
            }
        }
        ErrorController::not_found();
    }
}
