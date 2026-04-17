# Select Records

Now that we are connected to our database, let's select some records from our table.

We need access to the `$pdo` object. We don't want to include all of the code from the last lesson in every file where we want to use the database, so we can include the `database.php` file in a new file called `index.php`:

```php
require_once 'database.php';
```

Now we have access to the `$pdo` object. Let's select all of the records from the `posts` table:

```php
// Prepare a SELECT statement
$stmt = $pdo->prepare('SELECT * FROM posts');

// Execute the statement
$stmt->execute();

// Fetch the results
$results = $stmt->fetchAll();
```

Let's break this down:

- We use the `prepare()` method to prepare a `SELECT` statement. `prepare` is a method provided by the PDO class. It prepares an SQL statement for execution and returns a PDOStatement object. The prepare method is essential for writing secure database queries because it separates the SQL command from the data, reducing the risk of SQL injection attacks.
- We use the `execute()` method to execute the statement.
- We use the `fetchAll()` method to fetch all of the results from the database. This method returns an array of associative arrays.

Now, we have an array with all of the records from the `posts` table. You can check real quick by using `var_dump($results)`. You should see something like this:

```php
array(2) {
  [0]=>
  array(4) {
    ["id"]=>
    string(1) "1"
    ["title"]=>
    string(11) "Post One"
    ["body"]=>
    string(18) "This is post one"
  }
  [1]=>
  array(4) {
    ["id"]=>
    string(1) "2"
    ["title"]=>
    string(10) "Post Two"
    ["body"]=>
    string(19) "This is post two "
  }
}
```

Let's add a bit of HTML and show each post in the body:

```php
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script src="https://cdn.tailwindcss.com"></script>
  <title>Blog</title>
</head>

<body class="bg-gray-100">
  <header class="bg-blue-500 text-white p-4">
    <div class="container mx-auto">
      <h1 class="text-3xl font-semibold">My Blog</h1>
    </div>
  </header>
  <div class="container mx-auto p-4 mt-4">
    <?php foreach ($posts as $post) : ?>
      <div class="md my-4">
        <div class="rounded-lg shadow-md">
          <div class="p-4">
            <h2 class="text-xl font-semibold"><?php echo $post['title']; ?></h2>
            <p class="text-gray-700 text-lg mt-2"><?php echo $post['body']; ?></p>
          </div>
        </div>
      </div>
    <?php endforeach; ?>
  </div>
</body>

</html>
```

Now we have a list of all of the posts from the database.

In the next lesson, we will learn how to fetch a single record from the database.
