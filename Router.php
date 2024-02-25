<?php

class Router
{
    protected $routes = [];

    /**
     * Method to register a route
     *
     * @param string $method
     * @param string $uri
     * @param string $controller
     * 
     * @return void
     * 
     */
    public function register_route(string $method, string $uri, string $controller): void
    {
        $this->routes[] = [
            'method' => $method,
            'uri' => $uri,
            'controller' => $controller
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
     * Load error page
     *
     * @param int $http_code
     * 
     * @return void
     * 
     */
    public function error(int $http_code = 404): void
    {
        http_response_code($http_code);
        load_view("error/$http_code");
        exit;
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
    public function route(string $uri, string $method)
    {
        foreach ($this->routes as $route) {
            if ($route['uri'] === $uri && $route['method'] === $method) {
                require_once base_path($route['controller']);
                return;
            }
        }
        $this->error();
    }
}
