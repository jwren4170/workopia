# $\_SERVER - Understanding Server Variables

When working with web applications, it's essential to have access to various server-related information. In PHP, this information is made available through server variables using the `$_SERVER` superglobal array. There will be times when you need to access the file path, server name, user agent string and other values and these variables provide a convenient way to do so.

We will go over some of the common server variables and how to access them. We will also create a simple PHP script that displays the values of these variables in a web browser. Let's get started!

## Server Variables (`$_SERVER`)

Server variables (`$_SERVER`) are a superglobal array in PHP that provides information about the server environment and the current request. They contain details like request method, server name, port, user agent, and much more. Let's break down some of the common server variables and what they signify:

1. `$_SERVER['REQUEST_METHOD']`: This variable contains the HTTP request method used, such as GET, POST, or PUT. It helps determine the type of request being made.

2. `$_SERVER['SERVER_PROTOCOL']`: It stores the name and version of the protocol the request was made with, like HTTP/1.1.

3. `$_SERVER['SERVER_NAME']`: This variable holds the name of the server host, such as "www.example.com."

4. `$_SERVER['SERVER_PORT']`: It contains the port number through which the request is being processed (e.g., 80 for HTTP or 443 for HTTPS).

5. `$_SERVER['SERVER_SOFTWARE']`: It indicates the server software being used, like Apache/2.4.41.

6. `$_SERVER['SERVER_ADMIN']`: This variable stores the email address of the server administrator or webmaster.

7. `$_SERVER['DOCUMENT_ROOT']`: It specifies the root directory of the server where the current script is located.

8. `$_SERVER['SCRIPT_FILENAME']`: This variable holds the absolute path to the script being executed.

9. `$_SERVER['SCRIPT_NAME']`: It contains the relative path of the current script concerning the document root.

10. `$_SERVER['PHP_SELF']`: It provides the path to the currently executing script, including the filename.

11. `$_SERVER['REMOTE_ADDR']`: This variable stores the IP address of the client making the request.

12. `$_SERVER['HTTP_CONNECTION']`: It indicates the type of connection being used, such as "Keep-Alive" or "Close."

13. `$_SERVER['HTTP_HOST']`: This variable contains the host and port number, if specified, from the request header.

14. `$_SERVER['HTTP_REFERER']`: It stores the URL of the referring page, if available.

15. `$_SERVER['HTTP_USER_AGENT']`: This variable holds the user agent string, which typically identifies the client's browser and operating system.

16. `$_SERVER['QUERY_STRING']`: It contains the query string portion of the URL, if any.

17. `$_SERVER['REQUEST_URI']`: This variable represents the full URL of the current request, including the query string.

## Environment Variables (`$_ENV`)

Environment variables (`$_ENV`) in PHP allow you to access system-level configurations and custom environment settings. Unlike `$_SERVER`, which primarily deals with server-related information, `$_ENV` focuses on broader environment configurations.

In the provided example code below, we set an environment variable using `putenv('DB_USER=john')` and retrieve its value using `getenv('DB_USER')`. This can be particularly useful for storing sensitive information like database credentials or API keys securely.

By understanding these server and environment variables, you gain valuable insights into the server environment and can use environment variables to manage sensitive data effectively. These variables are instrumental when building robust web applications and ensuring they function optimally in various server environments.

## Using `isset()`

When working with superglobals, it's essential to check if the variable is set before using it. This is because superglobals are available in all scopes throughout a script's execution. If you try to access a superglobal that is not set, you will get an error. To avoid this, you can use the `isset()` function to check if the variable is set before using it.

Let's get some of the common server variables and display them in a web browser. We will use the `isset()` function to check if the variable is set before displaying it. If the variable is not set, we will set it to an empty string. This will prevent any errors from occurring.

```php
<?php
// Common server variables:
$requestMethod = isset($_SERVER['REQUEST_METHOD']) ? $_SERVER['REQUEST_METHOD'] : '';
$serverProtocol = isset($_SERVER['SERVER_PROTOCOL']) ? $_SERVER['SERVER_PROTOCOL'] : '';
$serverName = isset($_SERVER['SERVER_NAME']) ? $_SERVER['SERVER_NAME'] : '';
$serverPort = isset($_SERVER['SERVER_PORT']) ? $_SERVER['SERVER_PORT'] : '';
$serverSoftware = isset($_SERVER['SERVER_SOFTWARE']) ? $_SERVER['SERVER_SOFTWARE'] : '';
$serverAdmin = isset($_SERVER['SERVER_ADMIN']) ? $_SERVER['SERVER_ADMIN'] : '';
$documentRoot = isset($_SERVER['DOCUMENT_ROOT']) ? $_SERVER['DOCUMENT_ROOT'] : '';
$scriptFilename = isset($_SERVER['SCRIPT_FILENAME']) ? $_SERVER['SCRIPT_FILENAME'] : '';
$scriptName = isset($_SERVER['SCRIPT_NAME']) ? $_SERVER['SCRIPT_NAME'] : '';
$phpSelf = isset($_SERVER['PHP_SELF']) ? $_SERVER['PHP_SELF'] : '';
$remoteAddr = isset($_SERVER['REMOTE_ADDR']) ? $_SERVER['REMOTE_ADDR'] : '';
$connection = isset($_SERVER['HTTP_CONNECTION']) ? $_SERVER['HTTP_CONNECTION'] : '';
$host = isset($_SERVER['HTTP_HOST']) ? $_SERVER['HTTP_HOST'] : '';
$referer = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : '';
$userAgent = isset($_SERVER['HTTP_USER_AGENT']) ? $_SERVER['HTTP_USER_AGENT'] : '';
$queryString = isset($_SERVER['QUERY_STRING']) ? $_SERVER['QUERY_STRING'] : '';
$requestUri = isset($_SERVER['REQUEST_URI']) ? $_SERVER['REQUEST_URI'] : '';
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Server Information</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100">
  <div class="container mx-auto p-8 bg-white shadow-md mt-10 rounded-lg">
    <h1 class="text-3xl font-semibold mb-4 text-center">Server Information</h1>
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
      <div class="bg-gray-200 p-4 rounded-lg">
        <strong class="block mb-2">Request Method:</strong>
        <?= $requestMethod ?>
      </div>
      <div class="bg-gray-200 p-4 rounded-lg">
        <strong class="block mb-2">Server Protocol:</strong>
        <?= $serverProtocol ?>
      </div>
      <div class="bg-gray-200 p-4 rounded-lg">
        <strong class="block mb-2">Server Name:</strong>
        <?= $serverName ?>
      </div>
      <div class="bg-gray-200 p-4 rounded-lg">
        <strong class="block mb-2">Server Port:</strong>
        <?= $serverPort ?>
      </div>
      <div class="bg-gray-200 p-4 rounded-lg">
        <strong class="block mb-2">Server Software:</strong>
        <?= $serverSoftware ?>
      </div>
      <div class="bg-gray-200 p-4 rounded-lg">
        <strong class="block mb-2">Server Admin:</strong>
        <?= $serverAdmin ?>
      </div>
      <div class="bg-gray-200 p-4 rounded-lg">
        <strong class="block mb-2">Document Root:</strong>
        <?= $documentRoot ?>
      </div>
      <div class="bg-gray-200 p-4 rounded-lg">
        <strong class="block mb-2">Script Filename:</strong>
        <?= $scriptFilename ?>
      </div>
      <div class="bg-gray-200 p-4 rounded-lg">
        <strong class="block mb-2">Script Name:</strong>
        <?= $scriptName ?>
      </div>
      <div class="bg-gray-200 p-4 rounded-lg">
        <strong class="block mb-2">PHP Self:</strong>
        <?= $phpSelf ?>
      </div>
      <div class="bg-gray-200 p-4 rounded-lg">
        <strong class="block mb-2">Remote Addr:</strong>
        <?= $remoteAddr ?>
      </div>
      <div class="bg-gray-200 p-4 rounded-lg">
        <strong class="block mb-2">Connection:</strong>
        <?= $connection ?>
      </div>
      <div class="bg-gray-200 p-4 rounded-lg">
        <strong class="block mb-2">Host:</strong>
        <?= $host ?>
      </div>
      <div class="bg-gray-200 p-4 rounded-lg">
        <strong class="block mb-2">Referer:</strong>
        <?= $referer ?>
      </div>
      <div class="bg-gray-200 p-4 rounded-lg">
        <strong class="block mb-2">User Agent:</strong>
        <?= $userAgent ?>
      </div>
      <div class="bg-gray-200 p-4 rounded-lg">
        <strong class="block mb-2">Query String:</strong>
        <?= $queryString ?>
      </div>
      <div class="bg-gray-200 p-4 rounded-lg">
        <strong class="block mb-2">Request Uri:</strong>
        <?= $requestUri ?>
      </div>
    </div>
</body>

</html>
```
