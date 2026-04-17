# `$_FILES` Superglobal

Uploading files is a common task in web development, especially when building applications that involve user-generated content or file management systems. PHP provides a convenient way to handle file uploads through the `$_FILES` superglobal. In this lesson, we'll explore how to work with file uploads using `$_FILES` in PHP.

`$_FILES` is a multidimensional associative array in PHP that stores information about files uploaded via `HTTP POST`. It provides a structured way to access details about the uploaded files, such as their names, types, sizes, and temporary storage locations on the server.

## Getting File Information

Let's use the form and code from the `$_POST` lesson and add a logo image field:

```php
<?php
$title = '';
$description = '';
$submitted = false; 

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])) {
  $title = htmlspecialchars($_POST['title'] ?? '');
  $description = htmlspecialchars($_POST['description'] ?? '');

  $submitted = true;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Create Job Listing</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100">
  <div class="flex justify-center items-center h-screen">
    <div class="bg-white p-8 rounded shadow-md w-full max-w-md">
      <h1 class="text-2xl font-semibold mb-6">Create Job Listing</h1>
      <form method="post" enctype="multipart/form-data">
        <div class="mb-4">
          <label for="title" class="block text-gray-700 font-medium">Title</label>
          <input type="text" id="title" name="title" placeholder="Enter job title" class="w-full px-4 py-2 border rounded focus:ring focus:ring-blue-300 focus:outline-none" value="<?= $title ?>">
        </div>
        <div class="mb-6">
          <label for="description" class="block text-gray-700 font-medium">Description</label>
          <textarea id="description" name="description" placeholder="Enter job description" class="w-full px-4 py-2 border rounded focus:ring focus:ring-blue-300 focus:outline-none"><?= $description ?></textarea>
        </div>
        <div class="mb-4">
          <label for="resume" class="block text-gray-700 font-medium">Logo</label>
          <input type="file" id="logo" name="logo" class="w-full px-4 py-2 border rounded focus:ring focus:ring-blue-300 focus:outline-none">
        </div>
        <div class="flex items-center justify-between">
          <button type="submit" name="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 focus:outline-none">
            Create Listing
          </button>
          <a href="#" class="text-blue-500 hover:underline">Back to Listings</a>
        </div>
      </form>

      <!-- Display submitted data -->
      <?php if ($submitted) : ?>
        <div class="mt-6 p-4 border rounded bg-gray-200">
          <h2 class="text-lg font-semibold">Submitted Job Listing:</h2>
          <p><strong>Title:</strong> <?= $title ?></p>
          <p><strong>Description:</strong> <?= $description ?></p>
        </div>
      <?php endif; ?>
    </div>
  </div>
</body>

</html>
```

Notice that we added the `enctype="multipart/form-data"` attribute to the form element. This attribute is required when uploading files via `HTTP POST`.

When we submit the form, let's look at what is in the `$_FILES` superglobal:

```php
var_dump($_FILES);
```

You should see something like this:

```php
array(1) {
  ["logo"]=> array(6) {
    ["name"]=> string(26) "thumbnail.jpg"
    ["full_path"]=> string(26) "thumbnail.jpg"
    ["type"]=> string(10) "image/jpeg"
    ["tmp_name"]=> string(45) "C:\Users\trave\AppData\Local\Temp\php29F0.tmp"
    ["error"]=> int(0)
    ["size"]=> int(124599)
    } }
```

Let's look at each field and what it contains:

- `name`: The original name of the uploaded file.
- `full_path`: The full path to the uploaded file.
- `type`: The MIME type of the file (e.g., "image/jpeg").
- `tmp_name`: The temporary filename assigned to the file during the upload process.
- `error`: An error code (0 for success, other values for various errors).
- `size`: The size of the uploaded file in bytes.

We can access any of these values with the following syntax:

```php
echo $_FILES['logo']['name'];
```

## Uploading a File

Up to this point, we have not uploaded a file anywhere, we have only looked at the information about the file. Let's upload the file.

Create a folder in your working folder called `uploads`. This is where we will store the uploaded files.

Add the following code in the `$_POST` conditional right under where we set the `$title` and `$description` variables:

```php
 $file = $_FILES['logo'];

  // Check for upload errors
  if ($file['error'] === UPLOAD_ERR_OK) {
    // Specify the destination directory
    $uploadDir = 'uploads/';

    // Create the directory if it doesn't exist
    if (!is_dir($uploadDir)) {
      mkdir($uploadDir, 0755, true);
    }

    // Create a unique filename
    $filename = uniqid() . '_' . $file['name'];

    // Move the uploaded file to the destination directory
    if (move_uploaded_file($file['tmp_name'], $uploadDir . $filename)) {
      echo 'File uploaded successfully!';
    } else {
      echo 'Error uploading file.';
    }
  } else {
    echo 'File upload error: ' . $file['error'];
  }
```

We are checking for upload errors first. If there are no errors, we create the `uploads` directory if it doesn't exist. Then we create a unique filename using the `uniqid()` function and the original filename. Finally, we move the uploaded file to the `uploads` directory using the `move_uploaded_file()` function.

Try it out and you should see the message "File uploaded successfully!". Look in the `uploads` directory and you should see the uploaded file.

The message looks a bit out of place. In the next lesson, I want you to try out a challenge and make it so that the message is displayed in the form box.
