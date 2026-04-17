# $\_ENV & $\_GLOBALS Superglobals

In this lesson, we will look at environment and global variables. 

## Environment Variables (`$_ENV`)

Environment variables (`$_ENV`) in PHP allow you to access system-level configurations and custom environment settings. Unlike `$_SERVER`, which primarily deals with server-related information, `$_ENV` focuses on broader environment configurations. You can set and get environment variables from your PHP scripts, however, they are set at the server or system level. This means that they are not defined in the code and are not limited to PHP. They can be accessed by various programming languages and even shell scripts. They are global to the entire environment.

### Setting Environment Variables

With some setups, such as my own, we can't directly set environment variables using the`$_ENV` superglobal, however we have some methods to get and set them.

We can set environment variables with the `putenv()` function. This function takes a string as an argument, which is the name of the environment variable we want to set. The string should be in the format `VARIABLE_NAME=VALUE`.

```php
putenv('DB_HOST=localhost');
putenv('DB_USER=john');
```

### Getting Environment Variables

We can get the value of an environment variable with the `getenv()` function. This function takes a string as an argument, which is the name of the environment variable we want to get the value of.

```php
$host = getenv('DB_HOST');
$user = getenv('DB_USER');
```

You can get all of the environment variables as an associative array with the `getenv()` function without any arguments. This will show ALL of the environment variables, including the ones that are set by the system. This is useful for debugging purposes. However, it is not recommended to use this in production code because it may expose sensitive information.

```php
$env = getenv();
```

## Why Use Environment Variables?

Environment variables are useful for storing variables that are specific to the environment that the application is running in. For example, we can use environment variables to store database credentials. This is useful because we can set different credentials for different environments. For example, we can use different credentials for our local development environment and our production environment.

## Environment Variables vs `define()` Constants

Environment variables are similar to constants in that they both store values that cannot be changed. However, environment variables are different from constants in that they are not defined in the code. Environment variables are typically set at the server or system level. They are not limited to PHP and can be accessed by various programming languages and even shell scripts. They are global to the entire environment.

Constants defined using `define()` are scoped to the PHP script or application in which they are defined. They are not accessible outside of that script, making them more encapsulated.

#### Use Cases

- **Environment Variables**: They are often used for configuration settings that may change between different deployments or environments (e.g., development, staging, production). They are also commonly used for sensitive data like API keys and database credentials.
- **Constants**: Constants are used for values that should remain consistent and not change during the script's execution, such as error codes, file paths, or mathematical constants.

## Global Variables (`$_GLOBALS`)

The `$_GLOBALS` superglobal is an associative array that contains references to all variables that are currently defined in the global scope of the script. This includes variables that are defined outside of functions and variables that are defined inside functions but are not local to the function.

Let's look at an example:

```php
function test()
{
$foo = "local variable";

echo '$foo in global scope: ' . $GLOBALS["foo"] . "\n";
echo '$foo in current scope: ' . $foo . "\n";
}

$foo = "Example content";
test();
```

The above code will output the following:

```
$foo in global scope: Example content
$foo in current scope: local variable
```

As you can see, the `$GLOBALS` array contains a reference to the `$foo` variable that is defined outside of the `test()` function. It also contains a reference to the `$foo` variable that is defined inside the `test()` function. This is because the `$foo` variable is defined in the global scope of the script.

This can be useful if you want to access a global variable from within a function without having to pass it as an argument to the function. I would not recommend using this in your code because it can make your code harder to read and debug. It is better to pass variables as arguments to functions. I very rarely use the `$_GLOBALS` superglobal in my code.
