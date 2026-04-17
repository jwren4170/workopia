# Update Records

We want to be able to update a post.

## Edit Button

Now we want to be able to update a record. Let's start by creating an edit button on the post page. 

I am going to put the edit button above the delete form. I am also adding a class of `w-full` to the button in the delete form. So they will be stacked on top of eachother.

Here is the code:

```php
 <div class="container mx-auto p-4 mt-4">
    <div class="md my-4">
      <div class="rounded-lg shadow-md mb-5">
        <div class="p-4">
          <h2 class="text-xl font-semibold"><a href="post.php?id=<?= $post['id'] ?>"><?= $post['title']; ?></h2>
          <p class="text-gray-700 text-lg mt-2 mb-5"><?= $post['body']; ?></p>
          <a href="index.php">Go Back</a>
        </div>
      </div>

       <a href="edit.php?id=<?= $post['id'] ?>" class="bg-green-500 text-white px-4 py-2 rounded block w-full text-center mb-4 hover:bg-green-600 focus:outline-none">
        Edit</a>

      <form action="delete.php" method="post">
        <input type="hidden" name="_method" value="delete">
        <input type="hidden" name="id" value="<?= $post['id'] ?>">
        <button type="submit" name="submit" class="text-xl bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600 focus:outline-none w-full">Delete</button>
      </form>
    </div>
  </div>
```

We have a link to a page called `edit.php` and we are passing the id of the post in the query string.

## Edit Page

The edit page will be similar to the create form, especially the HTML, but remember we need to fetch the data first to put it into the form. Create a file called `edit.php` and add the following code:

```php
<?php
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
?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Update Blog Post</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100">
  <div class="flex justify-center items-center h-screen">
    <div class="bg-white p-8 rounded shadow-md w-full max-w-md">
      <h1 class="text-2xl font-semibold mb-6">Update Blog Post</h1>
      <form method="post">
      // ADD THESE TWO HIDDEN INPUTS
        <input type="hidden" name="_method" value="put">
        <input type="hidden" name="id" value="<?= $post['id'] ?>">
        <div class="mb-4">
          <label for="title" class="block text-gray-700 font-medium">Title</label>
          <input type="text" id="title" name="title" placeholder="Enter post title" class="w-full px-4 py-2 border rounded focus:ring focus:ring-blue-300 focus:outline-none" value="<?= $post['title'] ?? '' ?>">
        </div>
        <div class="mb-6">
          <label for="body" class="block text-gray-700 font-medium">Body</label>
          
          <textarea id="body" name="body" placeholder="Enter post body" class="w-full px-4 py-2 border rounded focus:ring focus:ring-blue-300 focus:outline-none"><?= $post['body'] ?? '' ?></textarea>
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

So what we have essentially done here is combine the post show database logic and the create form logic. We are fetching the post from the database and then using the values to populate the form.

Now we need to handle the submission. We could do it in another file, but I am going to do it here.

At the bottom of the PHP code, add the following:

```php
// Check if the form is submitted with the "put" method (for updating)
$isPutRequest = ($_SERVER['REQUEST_METHOD'] === 'POST' && ($_POST['_method'] ?? '') === 'put');

if ($isPutRequest) {

  $title = htmlspecialchars($_POST['title'] ?? '');
  $body = htmlspecialchars($_POST['body'] ?? '');

  // UPDATE statement with placeholders for title, body and id
  $sql = 'UPDATE posts SET title = :title, body = :body WHERE id = :id';

  // Prepare the statement
  $stmt = $pdo->prepare($sql);

  // Params for prepared statement
  $params = [
    'title' => $title,
    'body' => $body,
    'id' => $id
  ];

  // Execute the statement
  $stmt->execute($params);

  header('Location: index.php');
  exit;
}
```

We are checking for a post and a method of `put`. We are then getting the title and body from the form and updating the record in the database.

On redirect, you should see the updated post.

Now that we have the basics of PDO down, let's start our project and structure it in a more professional and organized way.
