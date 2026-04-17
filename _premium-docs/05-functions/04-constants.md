# Constants

In PHP, we have something called `constants`. Constants are similar to variables, but they cannot be changed. They are useful for storing values that you know will never change, such as the name of your application, your database info or the version number. You will see constants a lot inside of config files.

## Defining a constant

There are actually a couple ways to do this now. We have the `define()` function and we can also use the `const` keyword.

### define()

The `define()` function takes two parameters. The first parameter is the name of the constant and the second parameter is the value of the constant.

```php
define('APP_NAME', 'My App');
define('APP_VERSION', '1.0.0');
```

It is standard convention to use all caps for constants. It is not required, but it is a good practice and lets other developers know that it is a constant.

To access these constants, we simply use the constant name without the `$` sign.

```php
echo APP_NAME; // My App
echo APP_VERSION; // 1.0.0
```

Let's try and change the value of a constant:

```php
define('APP_NAME', 'My App 2');
```

If we try and run this code, we will get an error:

```php
Warning: Constant APP_NAME already defined
```

### Constants are global

Constants are global, so we can access them from anywhere in our code.

```php
function getAppName() {
  return APP_NAME;
}

echo getAppName(); // My App
```

There is no need to use the `global` keyword.

### const

We can also use the `const` keyword to define constants. This is more common to use within classes. We will learn more about classes later, but here is an example:

```php

class Person {
    const AVG_LIFE_SPAN = 79;

    public function getAverageLifeSpan() {
        return self::AVG_LIFE_SPAN;
    }
}

$person = new Person();
echo $person->getAverageLifeSpan(); // 79
```

I know we have not looked at object oriented programming yet, but I just wanted to show you this as an example. We will learn more about classes and objects later.

We can also use const globally outside of a class like this:

```php
const DB_NAME = 'mydb';
const DB_HOST = 'localhost';

echo DB_NAME, DB_HOST;
```

If we try and re-assign a const variable, we get an error:

```php
const DB_NAME = 'test';
```

```
Warning: Constant DB_NAME already defined in
```
