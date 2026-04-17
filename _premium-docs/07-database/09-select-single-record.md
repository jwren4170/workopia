# Select a Single Record from a Database

In the last lesson, we saw how to fetch all records from the database. Now we are going to learn how to fetch a single record. It is actualy very similar except we use the `fetch()` method instead of the `fetchAll()` method.

Let's create another file called `post.php` and include the `database.php` file:

```php
require_once 'database.php';
```

Before we do anything else here, I want to have a link on each post in the `index.php` that will link to this page and send the `id` of the post in the query string. Let's change the titles to have links in the `index.php` file.

```php
 <?php foreach ($posts as $post) : ?>
      <div class="md my-4">
        <div class="rounded-lg shadow-md">
          <div class="p-4">
            <h2 class="text-xl font-semibold"><a href="post.php?id=<?= $post['id'] ?>"><?= $post['title']; ?></a></h2>
            <p class="text-gray-700 text-lg mt-2"><?= $post['body']; ?></p>
          </div>
        </div>
      </div>
    <?php endforeach; ?>
```

Now in the `post.php` file, we can get the `id` from the query string and use it to fetch the post from the database.

```php
$id = $_GET['id'] ?? null;
```

By using the null coalescing operator, we can set the `$id` variable to `null` if the `id` is not in the query string. This will prevent an error from being thrown if the `id` is not in the query string.

Let's also redirect if there is no ID in the query string:

```php
if (!$id) {
  header('Location: index.php');
  exit;
}
```

## Prepared Statements

Now we can use the `id` to fetch the post from the database BUT we need to use a prepared statement to prevent SQL injection attacks.

Prepared statements allow us to use placeholders in our SQL statement and then pass the values for those placeholders in a separate array. This way, the values are not mixed in with the SQL statement and cannot be used to change the SQL statement.

Imagine if someone passed the following value for the `id` in the query string:

```
1; DROP TABLE posts;
```

If we used this value directly in our SQL statement, it would delete the `posts` table from the database. This is called an SQL injection attack.

We can prevent this by using a prepared statement. Let's create a variable called `$sql` and set it to the SQL statement that we want to execute:

```php
$sql = 'SELECT * FROM posts WHERE id = :id';
```

Notice that we are using a placeholder called `:id` instead of the actual value. We will pass the value for this placeholder in a separate array.

Now we can prepare the statement by calling the `prepare()` method on the PDO instance. This will return a `PDOStatement` object that we can use to execute the statement:

```php
$stmt = $pdo->prepare($sql);
```

Now we can execute the statement by calling the `execute()` method on the `PDOStatement` object. We will pass an array with the value for the placeholder:

```php
$stmt->execute(['id' => $id]);
```

I like to put the array in it's own variable so that it is easier to read:

```php
$params = ['id' => $id];

$stmt->execute($params);
```

Now we can fetch the post from the database by calling the `fetch()` method on the `PDOStatement` object:

```php
$post = $stmt->fetch();
```

Notice we used the singular form of the method name. This will fetch a single record from the database. If we used the plural form, `fetchAll()`, it would fetch all records from the database.

All together, it looks like this:

```php
require_once 'database.php';

// Get id from query string
$id = $_GET['id'] ?? null;

// If id is null, redirect to index.php
if (!$id) {
  header('Location: index.php');
  exit;
}

// SELECT statement with placeholder for id
$sql = 'SELECT * FROM posts WHERE id = :id';

// Prepare the SELECT statement
$stmt = $pdo->prepare($sql);

// Params for prepared statement
$params = ['id' => $id];

// Execute the statement
$stmt->execute($params);

// Fetch the post from the database
$post = $stmt->fetch();
```

## Display the Post

Now we can display the single post:

```php
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script src="https://cdn.tailwindcss.com"></script>
  <title><?= $post['title'] ?></title>
</head>

<body class="bg-gray-100">
  <header class="bg-blue-500 text-white p-4">
    <div class="container mx-auto">
      <h1 class="text-3xl font-semibold">My Blog</h1>
    </div>
  </header>
  <div class="container mx-auto p-4 mt-4">
    <div class="md my-4">
      <div class="rounded-lg shadow-md">
        <div class="p-4">
          <h2 class="text-xl font-semibold"><?= $post['title']; ?></h2>
          <p class="text-gray-700 text-lg mt-2 mb-5"><?= $post['body']; ?></p>
          <a href="index.php">Go Back</a>
        </div>
      </div>
    </div>
  </div>
</body>

</html>
```
