# Controller Classes

We have our router working with controller class methods. Let's add some more routes to `routes.php`:

```php
$router->get('/', 'HomeController@index');
$router->get('/listings', 'ListingController@index');
$router->get('/listings/create', 'ListingController@create');
$router->get('/listing', 'ListingController@show');
```

## `HomeController@index` Method

Let's start with the home controller. We want to essentially move the functionality from the `home.php` file.

Open the `HomeController` class and add the following:

```php
<?php

namespace App\Controllers;

use Framework\Database;

class HomeController
{
  protected $db;

  public function __construct()
  {
    $config = require basePath('config/db.php');
    $this->db = new Database($config);
  }

  /*
   * Show the latest listings
   *
   * @return void
   */
  public function index()
  {
    $listings = $this->db->query('SELECT * FROM listings LIMIT 6')->fetchAll();

    loadView('home', [
      'listings' => $listings
    ]);
  }
}

```

We are creating a property called `$db` and setting it to a new instance of the `Database` class. We are also creating a constructor method to do this.

Then we are getting the listings from the database and passing them to the view. It is the same logic as before, just in a class. Make sure that you use `$this->db` and not just `$db` since it is a property of the class.

There are so many different ways to do integrate the database with the controller. This is just one way. Later, I will show you how we can use a container so that we do not have to instantiate a new database object in every controller.

## `ListingController@index` Method

The `index` method of the `ListingController` is pretty much the same as the `HomeController` method. The only difference is that we are getting all listings instead of just 6 and loading a different view.

I am sticking with singular naming for the controller and plural for the view. This is just a personal preference.

```php
<?php

namespace App\Controllers;

use Framework\Database;

class ListingController
{
  protected $db;

  public function __construct()
  {
    $config = require basePath('config/db.php');
    $this->db = new Database($config);
  }

  /*
   * Show all listings
   *
   * @return void
   */
  public function index()
  {
    $listings = $this->db->query('SELECT * FROM listings')->fetchAll();

    loadView('listings/index', [
      'listings' => $listings
    ]);
  }
}
```

## `ListingController@create` Method

Let's add the create method. This will just load the create view.

```php
/*
   * Show the create listing form
   *
   * @return void
   */
  public function create()
  {
    loadView('listings/create');
  }
```

## `ListingController@show` Method

Now we will add the `show` method, which will show a single listing. We will use the `id` from the query string in the URL for now:

```php
/*
   * Show a single listing
   *
   * @return void
   */
  public function show()
  {
    $id = $_GET['id'];

    $params = [
      'id' => $id,
    ];

    $listing = $this->db->query('SELECT * FROM listings WHERE id = :id', $params)->fetch();

    loadView('listings/show', [
      'listing' => $listing,
    ]);
  }
```

## Error Controller

I want to create an error controller that will have a method for common errors like 404 and 403. However, I don't want to instantiate a new ErrorController in every method that I need it. So let's create static methods in the `ErrorController` class.

Create a new file in `App/Controllers` called `ErrorController.php` and add the following:

```php
namespace App\Controllers;

class ErrorController
{
  /*
     * 404 not found error
     *
     * @param string $message
     * @return void
     */
  public static function notFound($message = 'Resource Not Found')
  {
    http_response_code('404');
    loadView('error', [
      'status' => '404',
      'message' => $message,
    ]);
  }

  /*
     * 403 unauthorized error
     *
     * @param string $message
     * @return void
     */
  public static function unauthorized($message = 'You are unauthorized to access this resource')
  {
    http_response_code('403');
    loadView('error', [
      'status' => '403',
      'message' => $message,
    ]);
  }
}

```

We are just loading a view and passing a message.

Instead of having a folder called `errors` with a different view for each code, let's just have one view called `error.view.php` and pass the status code and message to it.

Add this to the `error.view.php` file:

```php
<?php loadPartial('head'); ?>
<?php loadPartial('navbar'); ?>
<?php loadPartial('top-banner'); ?>

<section>
  <div class="container mx-auto p-4 mt-4">
    <div class="text-center text-3xl mb-4 font-bold border border-gray-300 p-3"><?= $status ?> Error</div>
    <p class="text-center text-2xl mb-4">
      <?= $message; ?>
    </p>
  </div>
</section>

<?php loadPartial('footer'); ?>
```

Now, let's use this in our `ListingController@show` method. We will use the `notFound` method if the listing is not found:

```php
public function show()
  {
    $id = $_GET['id'];

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

Now you can delete the `App/controllers/listings` folder, the `App/controllers/error` folder, and the `App/controllers/home.php` file. You should only have your class files.

See how much we were able to clean things up? More to come.
