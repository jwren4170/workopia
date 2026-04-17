# Type Declarations

As I have said before, PHP is a dynamically typed language. We do not have to declare the type of a variable when we create it. PHP will automatically determine the type of a variable based on the value that we assign to it. This is true by default, BUT we can change this behavior by using `type declarations`, which were introduced in PHP5. This is completely optional, but it can be useful in some situations.

In order to use type declarations, you need to set a config option. You can do this from your `php.ini` file if you want to use it globally, or you can do it from your code if you only want to use it in a specific file.

To edit your `php.ini` file, you will need to know where it is located. You can find this out by running the following command in your terminal:

```bash
php --ini
```

This will print out the location of your `php.ini` file. Open that file in your text editor and add the following line:

```ini
declare_types=1
```

We are going to just use this in one file, so we will add the following line to the top of our file:

```php
declare(strict_types=1);
```

Now let's create a simple function that takes in two numbers and returns the sum of those numbers and let's use type declarations to make sure that the arguments and return values are the type of `int`:

```php
function getSum(int $a, int $b) : int {
  return $a + $b;
}
```

Now we can run it:

```php
echo getSum(1, 2); // 3
```

This works fine, but if we try to pass in a string, we will get an error:

```php
echo getSum('1', '2'); // TypeError: Argument 1 passed to getSum() must be of the type int, string given
```

So now it works like a statically typed language. This can be useful in some situations.

Let's try one more that takes in a string and returns a string:

```php
function greeting(string $name) : string {
  return "Hello $name";
}

echo greeting("John"); // Hello John
```

If we try to pass in a number, we will get an error:

```php
echo greeting(123); // TypeError: Argument 1 passed to greeting() must be of the type string, int given
```

### `void`

If you wanted to just echo something from a function and not have a return value, then you would use `void`:

```php
function greeting(string $name): void
{
  echo 'Hello ' . $name;
}

greeting();
```

That's it for type declarations. You can read more about them in the [PHP documentation](https://www.php.net/manual/en/functions.arguments.php#functions.arguments.type-declaration).
