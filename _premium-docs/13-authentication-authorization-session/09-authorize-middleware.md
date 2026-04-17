# Authorize Middleware

Now that we have a way to uniquely identify a user, we can create a middleware that will check if a user is logged in for certain routes. If they are not, they will be redirected to the login page. We will also have some routes that are only accessible to guests (non-logged in users) such as the login and register pages.

## What Is Middleware?

Middleware is essentially software/code that sits between a web application and web server. It acts as a bridge to process and manipulate requests and responses. Our middleware will look at the incoming request route and the roles that come with it and determine how the request should be routed.

## How This Will Work

We will be able to specify which routes are protected and which are not. We will do this by adding an array of `roles` to the route when we create it. For instance, if we only want authenticated users to access the '/listings/create' route, we would do this:

```php
$router->get('/listings/create', 'ListingsController@create', ['auth']);
```

If we only want guests to access the login page, we would do this:

```php
$router->get('/auth/login', 'UsersController@login', ['guest']);
```

## Create the Middleware

This is part of our app framework, so let's create a folder in the `Framework` folder called `Middleware`. In there, create a file called `Authorize.php`.

We will have a class called `Authorize` that will have a `handle` method that will take in a `role`:

```php
namespace Framework\Middleware;

use Framework\Session;

class Authorize
{
  /**
   * Check if the user is authenticated
   *
   * @param string $role
   * @return boolean
   */
  public function handle($role)
  {

  }
}
```

We are giving this the namespace of `Framework\Middleware` and we are using the `Session` class that we created earlier.

Now let's add a method to check if the user is authenticated. We will do this by checking if the user session is set.

```php
/**
 * Check if the user is authenticated
 *
 * @param string $role
 * @return boolean
 */
public function isAuthenticated()
{
  return Session::has('user');
}
```

Now, in the `handle` method, we can check the user role and if they are authenticated and redirect to the correct page:

```php
 public function handle($role)
  {
    if ($role === 'guest' && $this->isAuthenticated()) {
      return redirect('/');
    } elseif ($role === 'auth' && !$this->isAuthenticated()) {
      return redirect('/auth/login');
    }
  }
```

## Implement the Middleware

So we now have our middleware, but we need to implement it. We will do this in the `Router` class. Open `Framework/Router.php`.

The first thing we will do is use the `Authorize` class:

```php
use Framework\Middleware\Authorize;
```

Now we need to add a param to the `registerRoute` method that will include the middleware array:

```php
/**
   * Add a route to the router
   *
   * @param string $method
   * @param string $uri
   * @param string $action
   * @param array $middleware
   * @return void
   */
  public function registerRoute($method, $uri, $action, $middleware = [])
  {
    // Extract the controller and method from the action
    list($controller, $controllerMethod) = explode('@', $action);

    $this->routes[] = [
      'method' => $method,
      'uri' => $uri,
      'controller' => $controller,
      'controllerMethod' => $controllerMethod,
      'middleware' => $middleware,
    ];
  }
```

When we register a route, we will pass in the middleware array. We will then add it to the routes array. So we need to add the param to all of the methods `get`, `post`, `put` and `delete` in the `Router` class.

```php
 /**
   * Add a GET route to the router
   *
   * @param string $uri
   * @param string $controller
   * @param array $middleware
   * @return void
   */
  public function get($uri, $controller, $middleware = [])
  {
    $this->registerRoute('GET', $uri, $controller, $middleware);
  }

  /**
   * Add a POST route to the router
   *
   * @param string $uri
   * @param string $controller
   * @param array $middleware
   * @return void
   */
  public function post($uri, $controller, $middleware = [])
  {
    $this->registerRoute('POST', $uri, $controller, $middleware);
  }

  /**
   * Add a PUT route to the router
   *
   * @param string $uri
   * @param string $controller
   * @param array $middleware
   * @return void
   */
  public function put($uri, $controller, $middleware = [])
  {
    $this->registerRoute('PUT', $uri, $controller, $middleware);
  }

  /**
   * Add a DELETE route to the router
   *
   * @param string $uri
   * @param string $controller
   * @param array $middleware
   * @return void
   */
  public function delete($uri, $controller, $middleware = [])
  {
    $this->registerRoute('DELETE', $uri, $controller, $middleware);
  }
```

## Use The Middleware

Now we need to go into the `route` method and use the middleware. We want to add this code right after we check for `$match` and right above where we call the controller method:

```php
if ($match) {
  // Add this foreach
  foreach ($route['middleware'] as $middleware) {
    (new Authorize())->handle($middleware);
  }

  // Extract controller and method from route
  $controller = 'App\\Controllers\\' . $route['controller'];
  $controllerMethod = $route['controllerMethod'];

  // Instantiate the controller and call the method, passing parameters
  $controllerInstance = new $controller();
  $controllerInstance->$controllerMethod($params);

  return;
}
```

We are looping through the middleware array and calling the `handle` method on each one. We are passing in the middleware as a param. This will check if the user is authenticated or not and redirect them if needed.

## Add Middleware to Routes

Now, we can add our middleware with the roles to any route that we want. Open the `routes.php` file and add the middleware array as the last param where we want:

```php
$router->get('/', 'HomeController@index');
$router->get('/listings/create', 'ListingController@create', ['auth']);
$router->get('/listings/edit/{id}', 'ListingController@edit', ['auth']);
$router->get('/listings/{id}', 'ListingController@show');
$router->get('/listings', 'ListingController@index');

$router->post('/listings', 'ListingController@store', ['auth']);
$router->delete('/listings/delete/{id}', 'ListingController@destroy', ['auth']);
$router->put('/listings/{id}', 'ListingController@update', ['auth']);

$router->get('/auth/register', 'UserController@create', ['guest']);
$router->get('/auth/login', 'UserController@login', ['guest']);
$router->post('/auth/register', 'UserController@store', ['guest']);
$router->post('/auth/logout', 'UserController@logout', ['auth']);
$router->post('/auth/login', 'UserController@authenticate', ['guest']);
```

Now, try and visit the `/listings/create` route when you are not logged in. You should be redirected to the login page.

If you try and visit the login page while logged in, you should be able redirected to the homepage.
