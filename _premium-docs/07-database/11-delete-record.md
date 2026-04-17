# Delete Record

We know how to fetch and insert data, now we are going to delete. The issue that we have when working with the browser is that we can't send a `DELETE` request. We can only send `GET` and `POST` requests. To send a true `DELETE` request, we would need to use JavaScript and AJAX/Fetch.

To get around this, we are going to use a `POST` request and send a hidden input with the value of `DELETE`. We will then check for this value in our PHP code and delete the record.

Keep in mind, this code is very messy and unorganized. My goal for this section is just to get you familiar with PDO and using the database. In our final project, we will structure our code like a professional application. It also is not secure because obviously anyone would be able to delete a record. You need to implement authentication if you are going to have this type of functionality. We will get into that later.

## Delete Form

We want a delete button on the post page. However, it needs to send a `POST` request with a hidden field to indicate that we want to delete the record. So instead of a button, we will use a form.

Open the `post.php` file and add the following code:

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
      // ADD THIS
      <form action="delete.php" method="post">
        <input type="hidden" name="_method" value="delete">
        <input type="hidden" name="id" value="<?= $post['id'] ?>">
        <button type="submit" name="submit" class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600 focus:outline-none">Delete</button>
      </form>
    </div>
  </div>
```

What we are doing here is sending a post request to a file named `delete.php`, but adding a hidden field called `_method`. We are then setting that value to `delete`. We are also sending the `id` of the post that we want to delete in a hidden field.

## Delete Record

Create a file called `delete.php` and add the following code:

```php
<?php

require_once 'database.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['_method']) && $_POST['_method'] === 'delete') {
  echo 'Delete request received';
}
```

We are checking to see if the actual request is `post` and the hidden \_method field is `delete`.

We could clean it up:

```php
$isDeleteRequest = ($_SERVER['REQUEST_METHOD'] === 'POST' && ($_POST['_method'] ?? '') === 'delete');

if ($isDeleteRequest) {
  echo 'Delete request received';
}
```

If you click the delete button, you should see the message `Delete request received`. This means that we are receiving the request and we can now delete the record.

```php
require_once 'database.php';

$isDeleteRequest = ($_SERVER['REQUEST_METHOD'] === 'POST' && ($_POST['_method'] ?? '') === 'delete');

if ($isDeleteRequest) {
  $id = $_POST['id'];

  $sql = 'DELETE FROM posts WHERE id = :id';

  $stmt = $pdo->prepare($sql);

  $params = ['id' => $id];

  $stmt->execute($params);

  header('Location: index.php');
}
```

Now when you click the delete button, it will delete that post and redirect you to the index page.
