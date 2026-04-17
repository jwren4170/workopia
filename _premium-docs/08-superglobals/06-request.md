# `$_REQUEST` Superglobal

In PHP, the `$_REQUEST` superglobal is a built-in array that contains data that was submitted in an HTML form using either the `GET` or `POST` method. It is also used to get data from HTTP requests that are sent using either the `GET` or `POST` method. 

It may seem convienent to use the `$_REQUEST` superglobal, but it is not recommended. It is better to use the `$_GET` and `$_POST` superglobals instead. Mixing GET and POST data may lead to unexpected behavior and security vulnerabilities. However, I did want to mention it because you may come across it in legacy code.

I am just using the code from the `$_POST` tutorial. First I will show you that we can use `$_REQUEST` to get query params:

```php
echo $_REQUEST['name'] ?? ''; // Get query param
```

In your URL bar, add `?name=john`. It will work like the `$_GET` superglobal in this sense.

Now, change all of the `$_POST` to `$_REQUEST` and submit. It will work the same way.

```php
$title = '';
$description = '';
$submitted = false; // Flag to check if the form has been submitted

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_REQUEST['submit'])) {
  // $title = isset($_REQUEST['title']) ? htmlspecialchars($_REQUEST['title']) : '';
  // $description = isset($_REQUEST['description']) ? htmlspecialchars($_REQUEST['description']) : '';
  $title = htmlspecialchars($_REQUEST['title'] ?? '');
  $description = htmlspecialchars($_REQUEST['description'] ?? '');

  // Set the submitted flag to true
  $submitted = true;
}
```

So this may seem convient, but better to stick with `$_GET` and `$_POST`. It makes your code more predictable and easier to understand for both you and other developers who may work on your code in the future. Additionally, using `$_GET` and `$_POST` explicitly reflects the intention of your code, making it clear whether you expect data to be passed via URL query parameters or through the request body.