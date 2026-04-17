# Register Form Validation & Error Partials

We have our forms displayed, now we need to make them work. We will start with the registration form and storing the user. In this lesson, we will add the validation and also refactor a bit to create a partial for the error messages.

Start by creating the new route:

```php
$router->post('/auth/register', 'UserController@store');
```

This will be a post request to the `/auth/register` URL. Change the form in `views/users/create.view.php` to use the `POST` method and the new URL:

```html
<form action="/auth/register" method="POST"></form>
```

## `store` Method

Now in the `UserController` class, add the `store` method:

```php
 /**
   * Store a new user
   *
   * @return void
   */
  public function store()
  {
    echo 'store';
  }
```

Now when you submit the form, you should see `store` on the page.

## Validation

We need to do some validation. We will be using our `Validation` class. Add the following to the `store` method:

```php
public function store()
  {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $city = $_POST['city'];
    $state = $_POST['state'];
    $password = $_POST['password'];
    $passwordConfirmation = $_POST['password_confirmation'];
    $errors = [];

    // Validate email
    if (!Validation::email($email)) {
      $errors['email'] = 'Please enter a valid email address';
    }

    if (!Validation::string($name, 1, 50)) {
      $errors['name'] = 'Please enter a valid name';
    }

    // Validate password length
    if (!Validation::string($password, 6, 50)) {
      $errors['password'] = 'Password must be at least 6 characters long';
    }

    // Validate password match
    if (!Validation::match($password, $passwordConfirmation)) {
      $errors['password_confirmation'] = 'Passwords do not match';
    }


    if (!empty($errors)) {
      loadView('users/create', [
        'errors' => $errors,
        'user' => [
          'name' => $name,
          'email' => $email,
          'city' => $city,
          'state' => $state,
        ]
      ]);
      exit;
    }
  }
```

We are getting the form data and then validating it. If there are any errors, we are loading the view again and passing the errors to it. We pass in the input data as well as an array called `user`. We are also exiting the script so it doesn't continue.

## Show Errors

Now we need to show the errors in the view. Before we do that, since we are using the same code in the listing forms, let's create a partial for errors. Create a new file in `views/partials` called `errors.view.php` and add the following:

```php
<?php if (isset($errors)) : ?>
  <?php foreach ($errors as $error) : ?>
    <div class="message bg-red-100 p-3 my-3"><?php echo $error; ?></div>
  <?php endforeach; ?>
<?php endif; ?>
```

Now in the `App/views/listings/create.view.php` file, add this in place of the old code:

```php
<?= loadPartial('errors', [
  'errors' => $errors ?? [],
]) ?>
```

We are loading the partial and passing the `$errors` variable to it. We are also using the null coalescing operator to set the variable to an empty array if it doesn't exist.

We do have an issue though. The `loadPartial` function does not accept data like the `loadView` does. We can easily fix that. 

Open the `helpers.php` file and change your `loadPartial` to accept data and then extract it into variables.

```php
function loadPartial($name, $data = [])
{
  $partialPath = basePath("App/views/partials/{$name}.php");

  if (file_exists($partialPath)) {
    extract($data); // Add this
    require $partialPath;
  } else {
    echo "Partial '{$name} not found!'";
  }
}
```

Let's add the same partial to the `App/views/users/create.view.php` and the `App/views/users/login.view.php` files:

```php
//... rest of code
<?= loadPartial('errors', [
  'errors' => $errors ?? [],
]) ?>
//... rest of code
```

Now when you submit the form with invalid data, you should see the errors.

