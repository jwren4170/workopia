# Creating a Basic Router

So as we have it right now, there is a `public/index.php` file that loads a view. We want to be able to load different views based on the URL that is being requested. We also need a place for logic such as working with the database. That logic will go into a **controller**. This is a common pattern in web development. The controller will be responsible for loading the view and passing data to it.

We can't do this all within a single file. We need to create a router that will load the appropriate controller based on the URL that is being requested. This means, we need to route everything through the `public/index.php` file.

## Apache Users

If you are using the PHP dev server, you shouldn't have to do any extra configuration, however if you are using Apache whether it is Laragon, Xampp, etc, you have to enable URL rewriting. Basically, you want any route that does not have an actual `.php` file, to go through your `public/index.php` file. You need to create a file in your `public` folder called '.htaccess' to do this.

Create `public/.htaccess` and add the following:

```
RewriteEngine on
RewriteCond %{REQUEST_FILENAME} !-f
RewriteCond %{REQUEST_FILENAME} !-d
RewriteRule ^(.*)$ /index.php [NC,L,QSA]
```

This will enable you to route something like `http://workopia.test/listings` to the the `index.php` where we can then check for that URL and direct it to a specific controller file.


## Create Routes Array

Now that we have everything going through `public/index.php`, let's create an array for our routes.

Delete the loading of the view in the `public/index.php` file. We will replace it with the following routes array.

```php
$routes = [
  '/' => 'controllers/home.php',
  '/listings' => 'controllers/listings/index.php',
  '/listings/create' => 'controllers/listings/create.php',
  '404' => 'controllers/error/404.php' // Add this route
];
```

For now, we have four routes. The first route is the home page. The second route is the listings index page. The third route is the listings create page. The fourth route is the 404 page. We will have more later, but this is a good start.

Now we need to create the router logic. Add the following code to the `public/index.php` file:

```php
$uri = $_SERVER['REQUEST_URI'];

if (array_key_exists($uri, $routes)) {
  require basePath($routes[$uri]);
} else {
  require basePath($routes['404']);
}
```

This code will check if the requested route exists in the `$routes` array. If it does, it will load the appropriate controller. If it doesn't, it will load the 404 controller, which we will create later.

If you refresh the homepage, it should look for the `/` route in the `$routes` array. It will find it and load the `controllers/home.php` file. Of course, that file doesn't exist yet, so we will get an error, but we have a working router. It is probably the simplest router you will ever see, but it works.

Create a `controllers/home.php` file and add the following code:

```php
loadView('home');
```

Now your page should show again without any errors.

## Add Controller Files

Let's add the other controllers that we have in our routes as well. For now, we will just echo out a string. In the next video, we will create the views to load.

Create a `controllers/listings/index.php` file and add the following code:

```php
echo 'Listings';
```

If you go to the URL `/listings`, you should see this. If you see a "page not found" error or similar, then you probably have your `.htaccess` file setup wrong.

Create another file at `/controllers/listings/create` and add the following:

```php
echo 'Create Listing';
```

Make sure the route works.

Now create `/controllers/error/404.php` and add the following:

```php
echo '404';
```

Try going to any route that does not exist, such as `/hello`. You should see `404`.

In the next lesson we will add the views.
