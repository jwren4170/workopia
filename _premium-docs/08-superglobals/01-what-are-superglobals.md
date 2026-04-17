# What Are Superglobals?

Superglobals in PHP are a group of global variables that are accessible from anywhere within a PHP script, including functions and classes. These variables are associative arrays that store information about the current request, session, and server environment. Superglobals are one of the features of PHP that makes it so practical to work with, however, they can also be a source of security vulnerabilities if not used correctly. I think that is a big part of why some developers have an issue with PHP. It's not that they are inherently bad, but they can be misused.

## The Superglobals

There are nine superglobals in PHP. We'll cover each of them, but I just want to list them out here so you can see them all in one place.

All superglobals are prefixed with an underscore and are uppercase. For example, `$_GET` is the superglobal that contains all of the data from the `GET` request. This is to prevent naming collisions with other variables.

1. `$_GLOBALS`: This is an associative array that contains references to all variables which are currently defined in the global scope of the script. The variable names are the keys of the array.
2. `$_SERVER`: This is an associative array that contains information such as headers, paths, and script locations. The entries in this array are created by the web server.
3. `$_GET`: This is an associative array of variables passed to the current script via the URL parameters.
4. `$_POST`: This is an associative array of variables passed to the current script via the HTTP POST method.
5. `$_FILES`: This is an associative array of items uploaded to the current script via the HTTP POST method.
6. `$_COOKIE`: This is an associative array of variables passed to the current script via HTTP Cookies.
7. `$_SESSION`: This is an associative array containing session variables available to the current script.
8. `$_REQUEST`: This is an associative array that by default contains the contents of `$_GET`, `$_POST`, and `$_COOKIE`.
9. `$_ENV`: This is an associative array of variables passed to the current script via the environment method.

## Best Practices

As I mentioned, superglobals can be used improperly and lead to security vulnerabilities. Here are some best practices to follow when working with superglobals.

- **Never trust user input**: In web development, you want to assume there are people that will try to gain access to your system, break your code, or steal your data. This means that you should always sanitize and validate data before using it. This is especially true for `$_GET`, `$_POST`, and `$_COOKIE`.
- **Avoid direct usage**: Instead, create helper functions or classes to encapsulate data retrieval and processing. Use functions like `filter_input()` and `filter_var()` to sanitize and validate data.
- **Avoid using `$_REQUEST`**: It's better to use `$_GET`, `$_POST`, or `$_COOKIE` directly. This is because `$_REQUEST` contains the contents of all three of those superglobals. If you are expecting data from `$_GET` and `$_POST`, you may get unexpected results if the same key is used in both.
- **Use isset**: Always check to see if a superglobal is set before using it. This will prevent errors from being thrown if the superglobal is not set.
- **Session Management**: When using `$_SESSION`, be cautious with session handling to prevent security issues like session fixation, which is when an attacker sets the session ID of a user to one they know and then waits for the user to login. Once the user logs in, the attacker can use the session ID to gain access to the user's account.
- **Be cautious when using `$COOKIE`**: Cookies are stored on the user's computer and can be manipulated by the user. This means that you should never store sensitive data in cookies. Also, you can set the `httponly` flag to true when setting cookies. This will prevent the cookie from being accessed by JavaScript.

Alright, now that we've covered the basics of superglobals, let's take a look at each one individually.
