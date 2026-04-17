# Handling Route Params

For our `show` page, we are getting the ID from the query string in the URL. This is not the best way to do this. Instead, we should be using route parameters. This will allow us to have a URL like `/listings/1` instead of `/listings?id=1`. So yes, we are going to refactor the router again.

First, let's go to the `routes.php` file and change this:

```php
$router->get('/listing', 'ListingController@show');
```

to this:

```php
$router->get('/listings/{id}', 'ListingController@show');
```

This is in line with RESTful url standards. Now we need to update the `Router` class to handle this.

Open `Router.php` and modify the `route` method:

First, instead of passing the method in as a param, we are going to get it here and put it into a variable. The main reason for this is because later, we will need to manually pass in a `_method` input if we want to make a `PUT` or `DELETE` request. So we will need to match against that.

```php
public function route($uri) // Remove $method param
  {
    $requestMethod = $_SERVER['REQUEST_METHOD']; // Add this

    foreach ($this->routes as $route) {
      // ...
    }
  }
```

After making those changes, go to the `public/index.php` file and remove this line:

```php
$method = $_SERVER['REQUEST_METHOD'];
```

And remove the `$method` param from the `route` method call:

```php
$router->route($uri);
```

The app should still work the same way.

## Route Parameters

Now we need to account for the `{$id}` param in the route.

In the `route` method, we are going to add a bunch of code within the foreach. Replace everything in the foreach with the following:

```php
foreach ($this->routes as $route) {
  // Split the URI into segments
  $uriSegments = explode('/', trim($uri, '/'));

  // Split the route URI into segments
  $routeSegments = explode('/', trim($route['uri'], '/'));

  // Check if the number of segments matches
  if (count($uriSegments) === count($routeSegments) && strtoupper($route['method']) === $requestMethod) {
    $params = [];

    // Compare each segment
    $match = true;

    for ($i = 0; $i < count($uriSegments); $i++) {
      if ($routeSegments[$i] !== $uriSegments[$i] && !preg_match('/\{(.+?)\}/', $routeSegments[$i])) {
        $match = false;
        break;
      }
      if (preg_match('/\{(.+?)\}/', $routeSegments[$i], $matches)) {
        // This segment is a parameter, so store it
        $params[$matches[1]] = $uriSegments[$i];
      }
    }

    if ($match) {
      // Extract controller and method from route
      $controller = 'App\\Controllers\\' . $route['controller'];
      $controllerMethod = $route['controllerMethod'];

      // Instantiate the controller and call the method, passing parameters
      $controllerInstance = new $controller();
      $controllerInstance->$controllerMethod($params);
      return;
    }
  }
}
```

Let's go over this code:

First, we are splitting the URI and the route URI into segments. The `$uriSegments` will be an array of each segment in the URI. So if it is `/listings/1`, it will be:

```php
[
  'listings',
  '1'
]
```

We could get the id with `$uriSegments[1]`.

The `$routeSegments` will be an array of each segment in the route URI.

You can check and see all of the values by using our `inspectAll` helper function:

```php
inspectAll($uriSegments);
inspectAll($routeSegments);
```

We are then checking if the number of segments match and if the request method matches. So if we are hitting `/listings/2` with a `GET` request, it will match `GET` `/listings/{id}`.

Then we initialize an empty `$params` array and set `$match` to `true`.

We then loop through each segment and check if they match. If they don't match and the segment is not a parameter, we set `$match` to `false` and break out of the loop. The `preg_match` function is checking if the segment is a parameter with curly braces. So if it is something like `{id}`. If it is, it will return `true` and store the name of the parameter in `$matches[1]`. If not, it will set `$match` to `false` and break out of the loop.

If it is a match, we extract the controller and method from the route. We then instantiate the controller and call the method, passing in the `$params` array. This is the same as we had before, except now we are passing in the `$params` array, which we will have access to in the controller.

## Update Controller

Now, we have to update the `show` method in the `ListingController` to accept the `$params` array. We need to pass in the `$params` array and we no longer need the `$_GET` superglobal. Replace it with `$params['id']`:

```php
public function show($params)
  {
    $id = $params['id'];

    $params = [
      'id' => $id,
    ];

    $listing = $this->db->query('SELECT * FROM listings WHERE id = :id', $params)->fetch();

     // Check if listing exists
    if (!$listing) {
      ErrorController::notFound('Listing not found');
      return;
    }

    loadView('listings/show', [
      'listing' => $listing,
    ]);
  }
```

Now you should see the listing when you go to `/listings/1` or whatever id you want.

## Update Links

Now we just need to update any links that are using the query string. So in the `App/views/listings/index.view.php` file and in the `App/views/home.view.php`, change this:

```php
<a href="/listing?id=<?php echo $listing['id']; ?>">
```

to this:

```php
<a href="/listings/<?php echo $listing['id']; ?>">
```

Make sure you use plural. This adheres to RESTful standards.
