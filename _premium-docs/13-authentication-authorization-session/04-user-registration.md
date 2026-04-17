# User Registration

In this lesson, we will add the code to check if a user exists and to submit the user to the database.

## Check If Account Exists

We do not want to register two users with the same email. Let's check if the email already exists in the database. Add this to the `store` method:

```php
// Check if account exists
$params = [
  'email' => $email,
];

$user = $this->db->query('SELECT * FROM users WHERE email = :email', $params)->fetch();

if ($user) {
  $errors['email'] = 'That email already exists';
  loadView('users/create', [
    'errors' => $errors,
  ]);
  exit;
}
```

Now try and register with an email that already exists. You should see the error.

## Saving The User

Now, we need to save the data to the database. Paste this code in the `store` method where we left off:

```php
// Create account
$params = [
  'name' => $name,
  'email' => $email,
  'city' => $city,
  'state' => $state,
  'password' => password_hash($password, PASSWORD_DEFAULT),
];

$this->db->query('INSERT INTO users (name, email, city, state, password) VALUES (:name, :email, :city, :state, :password)', $params);

// Get the user id
$userId = $this->db->conn->lastInsertId();

inspectAndDie([
  'id' => $userId,
  'name' => $name,
  'email' => $email,
  'city' => $city,
  'state' => $state,
]);

redirect('/listings');
```

We are creating an array of parameters to pass to the query. We are also hashing the password with `password_hash`. We then insert the user into the database and get the ID of the user. We then inspect the user and redirect to the listings page. It won't redirect yet because we are inspecting the user. You should see the user data in the browser. We are able to get the users ID because we are using the `lastInsertId` method on the database connection.

You can check the database using something like MySQL Workbench to see if the user was added.

What we want to do next is create a session for the user.

Before we do that, I want to create a class within our `Framework` to handle sessions. We will do that next.
