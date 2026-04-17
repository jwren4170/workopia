# Session Class

We can now create a user, but we also want to create a session so that the user is logged in. We will create a `Session` class with static methods that will handle all of our session related tasks.

## Create the Class

Create a file in `Framework/Session.php` and add this code:

```php
namespace Framework;

class Session
{

  /**
   * Start the session
   *
   * @return void
   */
  public static function start()
  {
    if (session_status() == PHP_SESSION_NONE) {
      session_start();
    }
  }

  /**
   * Set a session key/value pair
   *
   * @param string $key
   * @param mixed $value
   * @return void
   */
  public static function set($key, $value)
  {
    $_SESSION[$key] = $value;
  }

  /**
   * Get a session value by key
   *
   * @param string $key
   * @param mixed $default
   * @return mixed
   */
  public static function get($key, $default = null)
  {
    return isset($_SESSION[$key]) ? $_SESSION[$key] : $default;
  }

  /**
   * Check if a session key exists.
   *
   * @param string $key
   * @return bool
   */
  public static function has($key)
  {
    return isset($_SESSION[$key]);
  }

  /**
   * Clear a session key
   *
   * @param string $key
   * @return void
   */
  public static function clear($key)
  {
    if (isset($_SESSION[$key])) {
      unset($_SESSION[$key]);
    }
  }

  /**
   * Clear all session data
   *
   * @return void
   */
  public static function clearAll()
  {
    session_unset();
    session_destroy();
  }
}
```

Now, we need to change some things around.

First, open the `public/index.php` and call the `start` method at the top. You will need to use the `use` statement at the top and move the `helpers.php` include below it:

```php
<?php
require __DIR__ . '/../vendor/autoload.php';

use Framework\Router;
use Framework\Session;

Session::start();

require __DIR__ . '/../helpers.php';
```


## Handle User Session

Now, let's handle the user session.

In the `store` method of the `UserController`, replace the `inspectAll` call with this:

```php
Session::set('user', [
  'id' => $userId,
  'name' => $name,
  'email' => $email,
  'city' => $city,
  'state' => $state,
]);
```

It's up to you on what you want to store. You could just store the ID, but I want the other meta data so we have it available.

Now, register a new user. If you want to delete the users from the database, you can do that via MySQL Workbench or any other utility.

Once you register, you should have a session with the user data. You can check this by inspecting the `user` session variable in the `public/index.php` file:

```php
inspectAndDie(Session::get('user'));
```

In the next lesson, we will edit the navbar to show the user's name and add a logout link.
