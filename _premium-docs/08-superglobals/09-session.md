# `$_SESSION` Superglobal

In web development, maintaining user data across multiple requests is a fundamental requirement. PHP provides a built-in mechanism for this purpose called `$_SESSION`. The `$_SESSION` superglobal enables developers to store and manage user-specific data on the server-side, ensuring it persists between HTTP requests. In this lesson, we'll explore what `$_SESSION` is, how it works, and how to use it effectively in your PHP applications.

## Understanding PHP Sessions

A session, in the context of web development, represents a series of interactions or requests made by a single user during their visit to a website. Sessions are critical for tasks such as user authentication, shopping carts, and user-specific preferences. Without sessions, web applications would have no way of identifying and remembering individual users.

Here's how sessions typically work:

- **Session Initialization**: When a user visits a website, the server creates a unique session for that user. This session is identified by a session ID, which is usually stored in a browser cookie.

- **Data Storage**: As the user interacts with the website, you can store data specific to that user in the `$_SESSION `superglobal. This data can be accessed and updated throughout the user's session.

- **Data Retrieval**: On subsequent requests, the server can retrieve the session data associated with the user using the session ID stored in the cookie.

- **Session Termination**: Sessions can be terminated explicitly, or they may expire after a predefined period of inactivity. This releases server resources and ensures privacy.

## Starting a Session

Before you can use the `$_SESSION` superglobal, you must first start a session. This is done using the `session_start()` function. This function must be called before any output is sent to the browser, otherwise, you'll get an error.

```php
session_start();
```

It's important to know that if you want to use the `$_SESSION` superglobal, you must call `session_start()` on every page that needs access to session data. This is because the session ID is stored in a cookie, which is sent to the server with every request. If you don't call `session_start()` on a page, the server won't be able to retrieve the session ID, and therefore won't be able to retrieve the session data. It also needs to be called before any output is sent to the browser.

Start a session and then set a session variable called `username` to the value `john`:

```php
session_start();

$_SESSION['username'] = 'john';
```

You can see what is in the session array with `var_dump()` or `print_r()`:

```php
  print_r($_SESSION);
```

Now, create another page called `page.php` and add the following code:

```php
session_start();

if (isset($_SESSION['username'])) {
  echo $_SESSION['username'];
}

```

Now go to `page.php` in your browser. You should see the value `john` printed to the screen. This is because the session data is persisted between requests. This is an extremely helpful feature that allows you to store and retrieve data across multiple pages.

## Unset Variables & Destroy a Session

Create another page called `destroy.php` and add the following code:

You can unset a single session variable by using the `unset()` function:

```php
session_start();

unset($_SESSION['username']);
```

You can also destroy the entire session by using the `session_destroy()` function:

```php
session_start();

session_destroy();
```

This will destroy the session and all the data associated with it. Now, go to `page.php` in your browser. You should see nothing printed to the screen. This is because the session has been destroyed, and the data is no longer available.

## Custom Session Settings

You can customize things like how long the session will last by using the `session_set_cookie_params()` function. This function must be called before `session_start()`.

```php
session_name("my_session_name");

// Set session cookie parameters (optional)
session_set_cookie_params([
    'lifetime' => 3600, // 1 hour
    'path'     => '/', // All paths on the domain
    'domain'   => '.example.com', // All subdomains of example.com
    'secure'   => true, // Only send cookie over HTTPS, requires SSL certificate
    'httponly' => true, // Only accessible over HTTP (no JavaScript)
    'samesite' => 'Lax', // Lax means cookies are sent on cross-domain requests via GET but not POST
]);

// Start the session
session_start();
```

## `session.save_path`

By default, PHP stores session data in a temporary directory on the server. The location of this directory is determined by the `session.save_path` directive in the `php.ini` file, which is the configuration file for PHP. Where this file is located depends on a few things such as your operating system as well as how PHP was installed. On a Linux web server you can find the location of the `php.ini` file by running the following command:

```bash
php -i | grep php.ini
```

If you are using a mac, like I am, you can find the location of the `php.ini` file by running the following command:

```bash
php --ini
```

If you are using Windows and Laragon, you can find the location of the `php.ini` file by clicking on the Laragon icon in the system tray and then clicking on `PHP > php.ini`.

If you find the `php.ini` file, open it up in your text editor and search for `session.save_path`. You should see something like this:

```ini
;session.save_path = "/tmp"
```

Then you can go to that directory and you should see a bunch of files that look like this:

```bash
sess_qv4erlk6025o66fqgm6b37q5u2
```

These files contain the session data. You can open them up in your text editor and see the data that is stored in them. You can also delete them if you want to destroy the session.

We will work with sessions more later on when we create a login system.

I did't mean that as an insult. I was half joking. And the links honestly are not a big deal, I just prefer the project at the top. Unless of course it is sponsored and I have to be a slave to the company
