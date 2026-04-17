# Router Class & Methods

So we have an extremely simple procedural router right now that loads a specific controller when a route is hit. However, we need more than that. We need a way to pass the HTTP method into the controller. If we just want to go to a route, that would be a GET request, but if we are submitting a form to create data, that would be a POST request. We also want to be able to send DELETE requests and also PUT requests for updating data.

So let's turn our router into a class and add some methods to it that represent the HTTP methods. Then we will be able to do things like this:

```php
$router->get('/listings', 'controllers/listings/index.php');
$router->post('/listings', 'controllers/listings/store.php');
```

Ultimately, we will also be able to have our controllers in classes and have the ability to add middleware, but this is the next step in the evolution of our router.

## Router Class

Since our router will be a class, we want to name the file starting with an uppercase letter, so change the name of the file to `Router.php` and create a class in it with a `$routes` property that is an empty array.

```php
<?php

class Router
{
  public $routes = [];
}
```

## Methods

Now, we will create a class method for each of the HTTP methods that we want to be able to use. This will be `get`, `post`, `put`, and `delete`. Each of these methods will take two arguments, the route/uri and the controller file path.

```php
<?php

/**
 * Router for the application
 */
class Router
{
  protected $routes = [];

  /**
   * Add a GET route to the router
   *
   * @param string $uri
   * @param string $controller
   * @return void
   */
  public function get($uri, $controller)
  {
  }

  /**
   * Add a POST route to the router
   *
   * @param string $uri
   * @param string $controller
   * @return void
   */
  public function post($uri, $controller)
  {
  }

  /**
   * Add a PUT route to the router
   *
   * @param string $uri
   * @param string $controller
   * @return void
   */
  public function put($uri, $controller)
  {
  }

  /**
   * Add a DELETE route to the router
   *
   * @param string $uri
   * @param string $controller
   * @return void
   */
  public function delete($uri, $controller)
  {
  }
}
```

Each of these methods will add a new route to the `$routes` array and will have the uri, controller, and method as keys. So let's add that to the `get` method.

```php
 public function get($uri, $controller)
  {
    $this->routes[] = [
      'method' => 'GET',
      'uri' => $uri,
      'controller' => $controller
    ];
  }
```

Now, if we do it this way, we will be repeating ourselves quite a bit because the only difference between each of these methods is the HTTP method. So let's create a `registerRoute` method that will take the method as an argument and then add the route to the `$routes` array.

```php
class Router
{
  protected $routes = [];

  /**
   * Add a route to the router
   *
   * @param string $method
   * @param string $uri
   * @param string $controller
   * @return void
   */
  public function registerRoute($method, $uri, $controller)
  {
    $this->routes[] = [
      'method' => $method,
      'uri' => $uri,
      'controller' => $controller
    ];
  }

  //....
}
```

Now our other methods can just call this method and pass in the method as the first argument.

```php
<?php

/**
 * Router for the application
 */
class Router
{
  protected $routes = [];

  /**
   * Add a route to the router
   *
   * @param string $method
   * @param string $uri
   * @param string $controller
   * @return void
   */
  public function registerRoute($method, $uri, $controller)
  {
    $this->routes[] = [
      'method' => $method,
      'uri' => $uri,
      'controller' => $controller
    ];
  }

  /**
   * Add a GET route to the router
   *
   * @param string $uri
   * @param string $controller
   * @return void
   */
  public function get($uri, $controller)
  {
    $this->registerRoute('GET', $uri, $controller);
  }

  /**
   * Add a POST route to the router
   *
   * @param string $uri
   * @param string $controller
   * @return void
   */
  public function post($uri, $controller)
  {
    $this->registerRoute('POST', $uri, $controller);
  }

  /**
   * Add a PUT route to the router
   *
   * @param string $uri
   * @param string $controller
   * @return void
   */
  public function put($uri, $controller)
  {
    $this->registerRoute('PUT', $uri, $controller);
  }

  /**
   * Add a DELETE route to the router
   *
   * @param string $uri
   * @param string $controller
   * @return void
   */
  public function delete($uri, $controller)
  {
    $this->registerRoute('DELETE', $uri, $controller);
  }
}
```

## Load Routes

We now have a router class with methods for each of the HTTP methods that we want to use. Now we need to load the routes into the router. So let's create a `route` method that will take the uri and method as arguments and then loop through the routes and return the controller if the uri and method match. It will load the 404 page if there is no match.

```php
/**
   * Route the request
   *
   * @param string $uri
   * @param string $method
   * @return void
   */
  public function route($uri, $method)
  {
    foreach ($this->routes as $route) {
      if ($route['uri'] === $uri && $route['method'] === $method) {
        require basePath($route['controller']);
        return;
      }
    }

    http_response_code(404);
    loadView("error/{$code}");
    exit;
  }
```

## Using the Router

Now, we can use the router in our `public/index.php` file. So let's require the router file and then create a new instance of the router. Then we can use the router to add routes and then route the request.

Your `public/index.php` file should now look like this:

```php
require '../helpers.php';

require basePath('Router.php');

$router = new Router;

$routes = require basePath('routes.php');
$uri = $_SERVER['REQUEST_URI'];
$method = $_SERVER['REQUEST_METHOD'];

$router->route($uri, $method);
```

We are bringing in the router, routes and then instantiating a router object. Then we are getting the uri and method from the request. Then we are using the router to route the request.

## Routes File

Now we need to update the `routes.php` file too take a method. So let's change the routes file to look like this:

```php
$router->get('/', 'controllers/home.php');
$router->get('/listings', 'controllers/listings/index.php');
$router->get('/listings/create', 'controllers/listings/create.php');
```

We no longer need to return the routes array because we are adding the routes to the router object. This is a much more object oriented approach to our router. We also do not need to add a 404 route because we are handling that in the router.

## Clean Up 404 Handling

I just want to clean things up a bit in the `Router` class method `route`. Let's separate the error handling into its own method and then call that method if there is no match. Let's also add the ability to pass in our own error code.

Put this right above the `route` method:

```php
/**
   * Load error page
   *
   * @return void
   */
  public function error($httpCode = 404)
  {
    http_response_code($httpCode);
    loadView("error/{$code}");
    exit;
  }
```

Update your `route` method to look like this:

```php
/**
   * Route the request
   *
   * @param string $uri
   * @param string $method
   * @return void
   */
  public function route($uri, $method)
  {
    foreach ($this->routes as $route) {
      if ($route['uri'] === $uri && $route['method'] === $method) {
        require basePath($route['controller']);
        return;
      }
    }

    $this->error();
  }
```

Alright, our router is starting to look more professional. We have a class with methods for each of the HTTP methods and we are using the router to add routes and then route the request. We also have a method for showing an error page.
