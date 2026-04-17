# `$_POST` Superglobal

In PHP, `$_POST` is a superglobal array that allows you to retrieve data that has been sent to the server using the `HTTP POST` method. It is commonly used to handle form submissions and other types of user input. In this lesson, we will explore the `$_POST` superglobal and how it works.

When a user submits an HTML form with the method attribute set to "post," the form data is sent to the server in the body of the HTTP request. PHP then automatically parses this data and stores it in the $\_POST array, making it accessible to your PHP script.

In order to explore this, let's create a simple HTML form that will send data to a PHP script. Here is the HTML form:

```html
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Create Job Listing</title>
    <script src="https://cdn.tailwindcss.com"></script>
  </head>

  <body class="bg-gray-100">
    <div class="flex justify-center items-center h-screen">
      <div class="bg-white p-8 rounded shadow-md w-full max-w-md">
        <h1 class="text-2xl font-semibold mb-6">Create Job Listing</h1>
        <form method="post">
          <div class="mb-4">
            <label for="title" class="block text-gray-700 font-medium"
              >Title</label
            >
            <input
              type="text"
              id="title"
              name="title"
              placeholder="Enter job title"
              class="w-full px-4 py-2 border rounded focus:ring focus:ring-blue-300 focus:outline-none"
            />
          </div>
          <div class="mb-6">
            <label for="description" class="block text-gray-700 font-medium"
              >Description</label
            >
            <textarea
              id="description"
              name="description"
              placeholder="Enter job description"
              class="w-full px-4 py-2 border rounded focus:ring focus:ring-blue-300 focus:outline-none"
            ></textarea>
          </div>
          <div class="flex items-center justify-between">
            <button
              type="submit"
              name="submit"
              class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 focus:outline-none"
            >
              Create Listing
            </button>
            <a href="#" class="text-blue-500 hover:underline"
              >Back to Listings</a
            >
          </div>
        </form>
      </div>
    </div>
  </body>
</html>
```

This form has two user input fields, one for the job title and one for the job description. It also has a submit button that will submit the form. You can submit to any file. Since there is no `action` attribute, it will submit to the same file. If you wanted to submit to let's say 'process.php', you coul do this:

```html
<form action="process.php" method="post"></form>
```

But we want to leave the action off so that it submits to itself. You can also submit to the same file using `$_SERVER['PHP_SELF']` like this:

```html
<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post"></form>
```

When the user submits the form, the data will be sent to the same PHP script that is rendering the form. Let's get that data using the `$_POST` superglobal.

There is another `$_SERVER` variable called `REQUEST_METHOD` that contains the request method that was used to access the current PHP script. We can use this to check if the form was submitted using the `POST` method. We should also check for the `submit` button in the `$_POST` array to make sure the form was submitted.

```php
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])) {
    var_dump($_POST);
}
```

You can see that the `$_POST` array contains the form data that was submitted. The keys in the array are the names of the form fields, and the values are the values that were entered into the form fields. In an actual application, you would probably want to do something with this data, like store it in a database. But for now, let's just display the data back to the user.

## Preventing XSS Attacks

I want to show you an example of some code that is vulnerable to a type of attack called a cross-site scripting attack, or XSS attack. This is a type of attack where a malicious user can inject malicious code into your application. This code will then be executed by other users when they visit your application. This can be used to steal sensitive information and do other malicious things.

Here is the code that is vulnerable to an XSS attack:

```php
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])) {
    $title = $_POST['title'];
    $description = $_POST['description'];
    echo "<h1>$title</h1>";
    echo "<p>$description</p>";
}
```

At first glance, this code looks fine. It is just echoing the data that was submitted in the form. But let's see what happens when we submit the following as the title value in the form:

```html
<script>
  alert('You have been hacked!');
</script>
```

When we submit this code in the form, it executes the JavaScript code and displays an alert box that says "You have been hacked!" This is a very simple example of an XSS attack, but it shows how dangerous it can be if there were malicious code that was trying to steal sensitive information.

## `htmlspecialchars()`

There are a few things that we can do to prevent this kind of thing. One of the easiest is to use the `htmlspecialchars()` function to escape any HTML characters in the data that is submitted in the form. This will prevent the browser from executing any HTML or JavaScript code that is submitted in the form.

Let's check for the `title` and `description` keys in the `$_POST` array and escape the values using the `htmlspecialchars()` function:

```php
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])) {
    $title = isset($_POST['title']) ? htmlspecialchars($_POST['title']) : '';
    $description = isset($_POST['description']) ? htmlspecialchars($_POST['description']) : '';
    echo "<h1>$title</h1>";
    echo "<p>$description</p>";
}
```

You can also use the null coalescing operator to set default values for the `$title` and `$description` variables if they are not set in the `$_POST` array:

```php
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])) {
    $title = htmlspecialchars($_POST['title'] ?? '');
    $description = htmlspecialchars($_POST['description'] ?? '');
    echo "<h1>$title</h1>";
    echo "<p>$description</p>";
}
```

Now, when we submit the form with the malicious code, it will not be executed by the browser. Instead, it will be displayed as plain text.

There are other measures that we can take to prevent XSS attacks, but this is a good start.

## Displaying The Listing

Instead of just displaying the info at the top, let's add it to the layout under the form. Get rid of the `echo` statements and add the following HTML below the form:

```html
<div class="mt-6 p-4 border rounded bg-gray-200">
  <h2 class="text-lg font-semibold">Submitted Job Listing:</h2>
  <p>
    <strong>Title:</strong>
    <?php echo $title; ?>
  </p>
  <p>
    <strong>Description:</strong>
    <?php echo $description; ?>
  </p>
</div>
```

We still have a problem though. If we go to the page without submitting the form, we get an error because the `$title` and `$description` variables are not defined. We can fix this by setting default values for these variables. At the very top, add the following:

```php
$title = '';
$description = '';
```

Now we shouldn't get any errors. However, the display box is still showing up even when we haven't submitted the form. We can fix this by using a `$submitted` flag. Add this with the other variables at the top:

```php
$submitted = false; // Flag to check if the form has been submitted
```

Now, when we submit the form, we can set the `$submitted` flag to `true`:

```php
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])) {
    $title = isset($_POST['title']) ? htmlspecialchars($_POST['title']) : '';
    $description = isset($_POST['description']) ? htmlspecialchars($_POST['description']) : '';

    $submitted = true;
}
```

Now, we can use this flag to only display the listing if the form has been submitted:

```php
<?php if ($submitted) : ?>
  <div class="mt-6 p-4 border rounded bg-gray-200">
      <h2 class="text-lg font-semibold">Submitted Job Listing:</h2>
      <p><strong>Title:</strong> <?php echo $title; ?></p>
      <p><strong>Description:</strong> <?php echo $description; ?></p>
  </div>
<?php endif; ?>
```

Now the listing will only be displayed if the form has been submitted.

## Keeping the Form Data

Another thing that we can do is keep the form data in the form fields when the form is submitted. This will make it easier for the user to correct any mistakes that they made when filling out the form. We can do this by setting the `value` attribute of the form fields to the values that were submitted in the form. Let's do this for the `title` and `description` fields:

```php
 <div class="mb-4">
    <label for="title" class="block text-gray-700 font-medium">Title</label>
    <input type="text" id="title" name="title" placeholder="Enter job title" class="w-full px-4 py-2 border rounded focus:ring focus:ring-blue-300 focus:outline-none" value="<?php echo $title; ?>">
  </div>
  <div class="mb-6">
     <label for="description" class="block text-gray-700 font-medium">Description</label>
    <textarea id="description" name="description" placeholder="Enter job description" class="w-full px-4 py-2 border rounded focus:ring focus:ring-blue-300 focus:outline-none"><?php echo $description; ?></textarea>
  </div>
```

We put the echo in the value attribute for the `title` field and the `description` field. Now, when we submit the form, the values that were submitted will be displayed in the form fields.

So that is the gist of how the `$_POST` superglobal works. It is a superglobal array that contains the data that was submitted in an HTML form using the `POST` method. It is also used to get data from HTTP requests that are sent using the `POST` method.

## `$_GET` vs. `$_POST`

I also want to mention that `$_GET` can be used with forms. If you add the following:

```html
<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="get"></form>
```

The form will be submitted using the `GET` method. If you submit the form, you will see that the data is now in the `$_GET` superglobal instead of the `$_POST` superglobal.

One really important difference is that with the `GET` method, the form data is sent in the URL. This means that the data will be visible in the URL. This is not the case with the `POST` method. The data is sent in the body of the HTTP request, so it is not visible in the URL.

You never want to use the `GET` method for forms that are submitting sensitive data, like passwords. You should always use the `POST` method for forms that are submitting sensitive data. It is ok to use the `GET` method for forms that are not submitting sensitive data, like search forms.
