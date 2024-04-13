<?php

namespace JWord\Framework;

use JWord\Framework\Middleware\Authorize;

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
     * @param array $middleware
     * 
     * @return void
     * 
     */
    public function register_route(string $method, string $uri, string $action, array $middleware = []): void
    {
        list($controller, $controller_method) = explode('@', $action);

        $this->routes[] = [
            'method' => $method,
            'uri' => $uri,
            'controller' => $controller,
            'controller_method' => $controller_method,
            'middleware' => $middleware
        ];
    }

    /**
     * Get route
     *
     * @param string $uri
     * @param string $method
     * @param array $middleware
     * 
     * @return void
     * 
     */
    public function get(string $uri, string $controller, array $middleware = []): void
    {
        $this->register_route('GET', $uri, $controller, $middleware);
    }

    /**
     * Post route
     *
     * @param string $uri
     * @param string $method
     * @param array $middleware
     * 
     * @return void
     * 
     */
    public function post(string $uri, string $controller, array $middleware = []): void
    {
        $this->register_route('POST', $uri, $controller, $middleware);
    }

    /**
     * put route
     *
     * @param string $uri
     * @param string $method
     * @param array $middleware
     * 
     * @return void
     * 
     */
    public function put(string $uri, string $controller, array $middleware = []): void
    {
        $this->register_route('PUT', $uri, $controller, $middleware);
    }

    /**
     * delete route
     *
     * @param string $uri
     * @param string $method
     * @param array $middleware
     * 
     * @return void
     * 
     */
    public function delete(string $uri, string $controller, array $middleware = []): void
    {
        $this->register_route('DELETE', $uri, $controller, $middleware);
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
    public function route(string $uri): void
    {
        $request_method = $_SERVER['REQUEST_METHOD'];

        // Check for _method input
        if (isset($_POST['_method']) && $request_method === 'POST') {
            $request_method = strtoupper($_POST['_method']);
        }

        foreach ($this->routes as $route) {

            // Split current URI into segments
            $uri_segments = explode('/', trim($uri, '/'));

            // Split route URI into segments
            $route_segments = explode('/', trim($route['uri'], '/'));

            $match = true;

            if (
                count($uri_segments) === count($route_segments) &&
                strtoupper($route['method']) === $request_method
            ) {
                $params = [];
                for ($i = 0; $i < count($uri_segments); $i++) {
                    if (
                        $route_segments[$i] !== $uri_segments[$i] &&
                        !preg_match('/\{(.+?)}/', $route_segments[$i])
                    ) {
                        $match = false;
                        break;
                    }

                    // Check uri params and add to $params array
                    if (preg_match('/\{(.+?)}/', $route_segments[$i], $matches)) {
                        $params[$matches[1]] = $uri_segments[$i];
                    }
                }

                if ($match) {
                    // Loop through middleware array
                    foreach ($route['middleware'] as $middleware) {
                        (new Authorize())->handle($middleware);
                    }

                    // Extract controller and controller method
                    $controller = 'JWord\\App\\Controllers\\' . $route['controller'];
                    $controller_method = $route['controller_method'];

                    // Instantiate the controller and call the method
                    $controller_inst = new $controller();
                    $controller_inst->$controller_method($params);

                    return;
                }
            }
        }
        ErrorController::not_found();
    }
}
