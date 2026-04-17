# Insert Records

Now we want to be able to add a new post to the database. We will create a form with a title and body field. When the form is submitted, we will insert the new post into the database.

Let's create a button on the `index.php` page to take us to a page called `create.php`:

```php
<div class="container mx-auto p-4 mt-4">
    <?php foreach ($posts as $post) : ?>
      <div class="md my-4">
        <div class="rounded-lg shadow-md">
          <div class="p-4">
            <h2 class="text-xl font-semibold"><a href="post.php?id=<?= $post['id'] ?>"><?= $post['title']; ?></h2>
            <p class="text-gray-700 text-lg mt-2"><?= $post['body']; ?></p>
          </div>
        </div>
      </div>
    <?php endforeach; ?>

    // ADD THIS
    <div class="mt-6">
      <a href="create.php" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 focus:outline-none">Create Post</a>
    </div>
  </div>
```

Now create a new file called `create.php`. We will use a similar form to what we used in the lesson on `$_POST`, except now it is for a blog post and not a job listing. Let's also get the data on submit.

Here is the code:

```php
<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])) {
  $title = htmlspecialchars($_POST['title'] ?? '');
  $body = htmlspecialchars($_POST['body'] ?? '');
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Create Blog Post</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100">
 <header class="bg-blue-500 text-white p-4">
    <div class="container mx-auto">
      <h1 class="text-3xl font-semibold">My Blog</h1>
    </div>
  </header>
  <div class="flex justify-center mt-10">
    <div class="bg-white p-8 rounded shadow-md w-full max-w-md">
      <h1 class="text-2xl font-semibold mb-6">Create Blog Post</h1>
      <form method="post">
        <div class="mb-4">
          <label for="title" class="block text-gray-700 font-medium">Title</label>
          <input type="text" id="title" name="title" placeholder="Enter post title" class="w-full px-4 py-2 border rounded focus:ring focus:ring-blue-300 focus:outline-none" value="<?= $title ?>">
        </div>
        <div class="mb-6">
          <label for="body" class="block text-gray-700 font-medium">Body</label>
          <textarea id="body" name="body" placeholder="Enter post body" class="w-full px-4 py-2 border rounded focus:ring focus:ring-blue-300 focus:outline-none"><?= $body ?></textarea>
        </div>
        <div class="flex items-center justify-between">
          <button type="submit" name="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 focus:outline-none">
            Submit
          </button>
          <a href="index.php" class="text-blue-500 hover:underline">Back to Posts</a>
        </div>
      </form>

    </div>
  </div>
</body>

</html>
```

I don't want to display the data here, so ultimatley, after we submit, we will be redirected to the index page.

Let's add the logic to submit to the database:
```php
require_once 'database.php';


if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])) {
  $title = htmlspecialchars($_POST['title'] ?? '');
  $body = htmlspecialchars($_POST['body'] ?? '');

  // Set the submitted flag to true
  $submitted = true;

  // INSERT statement with placeholders for title and body
  $sql = 'INSERT INTO posts (title, body) VALUES (:title, :body)';

  // Prepare the statement
  $stmt = $pdo->prepare($sql);

  // Params for prepared statement
  $params = [
    'title' => $title,
    'body' => $body
  ];

  // Execute the statement
  $stmt->execute($params);

  header('Location: index.php');
  exit;
}
```

We are creating our query with placeholders and then using a prepared statement to preven SQL injections. We add the values to the `$params` array to pass into the `execute` method. After it is submitted, we redirect to the home page.

Try submitting the form.
