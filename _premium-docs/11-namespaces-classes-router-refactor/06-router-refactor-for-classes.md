# Router Refactor For Controller Classes

At the moment, we are using single files as our controllers. That's fine for a small project like this, but it can get messy. We're going to be using controller classes instead.

I want to make it so that it loads a specific controller class method when we do something like this in our router:

```php
$router->get('/listings', 'ListingsController@index');
```

I also want to be able to pass parameters to the method like this:

```php
$router->get('/listings/{id}', 'ListingsController@show');
```

This is a better way to get the id than using the `$_GET` superglobal and query strings.

## Create `HomeController` Class

Let's start by just creating the `HomeController` class with the index method in it. This will be our homepage. Create a new file in `App/controllers` called `HomeController.php`. Add the following:

```php
namespace App\Controllers;

class HomeController
{
  public function index()
  {
    echo 'Home Page';
  }
}
```

That's it for now. I just want to be able to load this class and method from the router.

Open the `routes.php` file and comment out all routes and add this at the top:

```php
$router->get('/', 'HomeController@index');
```

Of course, this will break the application.

## Router Refactor

Open your `Router` class and add change your `registerRoute` method to look like this:

```php
 /**
   * Add a route to the router
   *
   * @param string $method
   * @param string $uri
   * @param string $action
   * @return void
   */
  public function registerRoute($method, $uri, $action)
  {
    // Extract the controller and method from the action
    list($controller, $controllerMethod) = explode('@', $action);

    $this->routes[] = [
      'method' => $method,
      'uri' => $uri,
      'controller' => $controller,
      'controllerMethod' => $controllerMethod
    ];
  }
```

Instead of passing a controller as an argument, we pass an action which looks like this - `ListingsController@index`. You can check this with `inspect($action)`.

We then use `explode` to split it into an array where the first item is the controller and the second is the method. The `list` function allows us to assign the array items to variables.

You can check this with `inspect($controller)` and `inspect($controllerMethod)`.

Then we add the controller and method to the route array.

## Update `route` Method

Now we need to use the controller and method in the `route` method. Change it to look like this:

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
        // Extract controller and method from route
        $controller = 'App\\Controllers\\' . $route['controller'];
        $controllerMethod = $route['controllerMethod'];

        // Instantiate the controller and call the method
        $controllerInstance = new $controller();
        $controllerInstance->$controllerMethod();

        return;
      }
    }

    $this->error();
  }
```

We are now instantiating the controller class and calling the method. Which controller and method depends on the current route.

So if it is the home page, it will load the `HomeController` class and call the `index` method.

Now, let's create a new file at `controllers/HomeController.php` and add the following:

```php
namespace App\Controllers;

class HomeController
{
  public function __construct()
  {
  }

  public function index()
  {
    die('HomeController@index');
  }
}
```

Now if you go to the homepage, you should just see `HoomeController@index`.

In the next lesson, we will add the rest of the code for the controller classes.
