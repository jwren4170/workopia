# Logout Functionality

Now we want to be able to logout and destroy the session. Let's start by adding the method and action to the logout form. Open the `App/views/partials/nav.php` file and make sure that the form with the logout button looks like this:

```html
<form method="POST" action="/auth/logout"></form>
```

Now we need to create the route. Open `routes.php` and add this:

```php
$router->post('/auth/logout', 'UserController@logout');
```

Let's create the `logout` method in the `UserController`. Open `App/controllers/UserController.php` and add this:

```php
/**
   * Logout the user
   *
   * @return void
   */
 public function logout()
  {
    Session::clearAll();

    $params = session_get_cookie_params();
    setcookie('PHPSESSID', '', time() - 86400, $params['path'], $params['domain']);

    redirect('/');
  }
```

We are using our `Session` class to destroy the session. We are destroying the session cookie as well. Then we redirect to the home page.

When you click the logout button, you should be redirected to the home page and the session should be destroyed. The navbar links should change.

In the next lesson, we will create the login functionality.
