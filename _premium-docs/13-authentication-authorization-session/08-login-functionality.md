# Login Functionality

We are able to register a user and then log in directly after and we can logout. Now we need a way for an existing user to authenticate.

## Login View/Form

We already have a login form. Open your `App/views/auth/login.view.php` file and make sure the form tag looks like this:

```html
<form action="/auth/login" method="POST"></form>
```

Right above it, get rid of the commented HTML and load the errors partial:

```php
<?= loadPartial('errors', [
      'errors' => $errors ?? [],
    ]) ?>
```

Add the value to the email input:

```php
 <input type="email" name="email" placeholder="Email Address" class="w-full px-4 py-2 border rounded focus:outline-none" value="<?= $user['email'] ?? '' ?>" />
```

Now let's add the route that we will submit to in the `routes.php` file:

```php
$router->post('/auth/login', 'UserController@authenticate');
```

So when we submit the form, it will call the `authenticate` method in the `UserController`. Let's create that next.

Create a method in the `UserController` called `authenticate`:

```php
/**
   * Authenticate the user
   *
   * @return void
   */
  public function authenticate()
  {
    echo 'auth';
  }
```

Now submit the form and you should see the text `auth` on the page. The form is now hooked up so let's add the logic:

## Validation

We will start with the validation:

```php
  public function authenticate()
  {
    $email = $_POST['email'];
    $password = $_POST['password'];
    $errors = [];

    // Validate email
    if (!Validation::email($email)) {
      $errors['email'] = 'Please enter a valid email address';
    }

    // Validate password length
    if (!Validation::string($password, 6, 50)) {
      $errors['password'] = 'Password must be at least 6 characters long';
    }

    if (!empty($errors)) {
      loadView('users/login', [
        'errors' => $errors,
      ]);
      exit;
    }
  }
```

Test out the form with invalid fields.

## Check If Account/Email Exists

The next step is to see if there is an account with that email:

```php
 // Check if account exists
$params = [
  'email' => $email,
];

$user = $this->db->query('SELECT * FROM users WHERE email = :email', $params)->fetch();

if (!$user) {
  $errors['email'] = 'Incorrect credentials';
  loadView('users/login', [
    'errors' => $errors,
  ]);
  exit;
}
```

Try an email that does NOT exist in the database and you should see the error.

## Verify Password

Now we need to verify the password. Remember, the password is hashed in the database. We can use the `password_verify` function to check if the password matches the hash.

```php
// Check if password is correct
if (!password_verify($password, $user->password)) {
  $errors['email'] = 'Incorrect credentials';
  loadView('users/login', [
    'errors' => $errors,
  ]);
  exit;
}

// Set user session
Session::set('user', [
  'id' => $user->id,
  'name' => $user->name,
  'email' => $user->email,
  'city' => $user->city,
  'state' => $user->state
]);

redirect('/listings');
```

Now try logging in with a valid email and password. You should be redirected to the listings page.

We now have an authentication system. We are not yet protecting any routes or pages, but we will do that next by creating authentication middleware.
