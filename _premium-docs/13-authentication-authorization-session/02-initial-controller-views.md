# Initial Controller & Views Setup

Let's start by creating a route to both the login and register controller methods. Open `routes.php` and add these routes:

```php
$router->get('/auth/register', 'UserController@create');
$router->get('/auth/login', 'UserController@login');
```

I am prefixing the routes with `/auth` but if you want the routes to be `/register` and `/login` that is fine. I just like to keep them separate from the main routes.

## Create the Controller

Now create a file at `App/controllers/UserController.php`. This will be our main controller for authentication and authorization.

Add this initial code:

```php
namespace App\Controllers;

use Framework\Database;
use Framework\Validation;

class UserController
{

  protected $db;

  public function __construct()
  {
    $config = require basePath('config/db.php');
    $this->db = new Database($config);
  }

  /**
   * Show the login page
   *
   * @return void
   */
  public function login()
  {
    loadView('users/login', [
      'errors' => $errors ?? [],
    ]);
  }

  /**
   * Show the registration page
   *
   * @return void
   */
  public function create()
  {
    loadView('users/create', [
      'errors' => $errors ?? [],
    ]);
  }
}
```

We are creating a class and initializing the database connection in the constructor just like we did with the listings. We then have a `login` and `create` method that will load the views for the login and register pages. I am using `create` instead of `register` because I am trying to stick to REST conventions. We will be using the `store` method to actually register the user.

Using `login` doe snot exactly follow REST conventions. You could create a separate controller for sessions and have a `create` and use that as your login, however, I like to keep all of the auth logic in a single controller.

## Create the Views

Now let's create the views. Create a folder at `App/views/users` and add `login.view.php` with this code from the `login.html` theme template:

```php
<?php loadPartial('head'); ?>
<?php loadPartial('navbar'); ?>

<!-- Login Form Box -->
<div class="flex justify-center items-center mt-20">
  <div class="bg-white p-8 rounded-lg shadow-md w-full md:w-500 mx-6">
    <h2 class="text-4xl text-center font-bold mb-4">Login</h2>
    <!-- <div class="message bg-red-100 p-3 my-3">This is an error message.</div>
        <div class="message bg-green-100 p-3 my-3">
          This is a success message.
        </div> -->
    <form>
      <div class="mb-4">
        <input type="email" name="email" placeholder="Email Address" class="w-full px-4 py-2 border rounded focus:outline-none" />
      </div>
      <div class="mb-4">
        <input type="password" name="password" placeholder="Password" class="w-full px-4 py-2 border rounded focus:outline-none" />
      </div>
      <button type="submit" class="w-full bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded focus:outline-none">
        Login
      </button>

      <p class="mt-4 text-gray-500">
        Don't have an account?
        <a class="text-blue-900" href="/auth/register">Register</a>
      </p>
    </form>
  </div>
</div>

<?php loadPartial('footer'); ?>
```

Be sure the register link at the bottom is pointing to `/auth/register`.

Now change the links in the navbar to `/auth/login` and `/auth/register`.

```php
<a href="/auth/login" class="text-white hover:underline">Login</a>
<a href="/auth/register" class="text-white hover:underline">Register</a>
```

Now create the `App/views/users/create.view.php` file and add this code from the `register.html` theme template:

```php
<?php loadPartial('head'); ?>
<?php loadPartial('navbar'); ?>

<!-- Registration Form Box -->
<div class="flex justify-center items-center mt-20">
  <div class="bg-white p-8 rounded-lg shadow-md w-full md:w-500 mx-6">
    <h2 class="text-4xl text-center font-bold mb-4">Register</h2>
    <!-- <div class="message bg-red-100 p-3 my-3">This is an error message.</div>
        <div class="message bg-green-100 p-3 my-3">
          This is a success message.
        </div> -->
    <form>
      <div class="mb-4">
        <input type="text" name="name" placeholder="Full Name" class="w-full px-4 py-2 border rounded focus:outline-none" />
      </div>
      <div class="mb-4">
        <input type="email" name="email" placeholder="Email Address" class="w-full px-4 py-2 border rounded focus:outline-none" />
      </div>
      <div class="mb-4">
        <input type="text" name="city" placeholder="City" class="w-full px-4 py-2 border rounded focus:outline-none" />
      </div>
      <div class="mb-4">
        <input type="text" name="state" placeholder="State" class="w-full px-4 py-2 border rounded focus:outline-none" />
      </div>
      <div class="mb-4">
        <input type="password" name="password" placeholder="Password" class="w-full px-4 py-2 border rounded focus:outline-none" />
      </div>
      <div class="mb-4">
        <input type="password" name="password_confirmation" placeholder="Confirm Password" class="w-full px-4 py-2 border rounded focus:outline-none" />
      </div>
      <button type="submit" class="w-full bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded focus:outline-none">
        Register
      </button>

      <p class="mt-4 text-gray-500">
        Already have an account?
        <a class="text-blue-900" href="/auth/login">Login</a>
      </p>
    </form>
  </div>
</div>

<?php loadPartial('footer'); ?>
```

So now we have our links/pages working. In the next lesson, we will work on the register/create/store functionality.
