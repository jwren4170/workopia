# `inspect` Debug Helper

There will be many times where you want to inspect the value of a variable or object. We will create two functions in our `helpers.php` file to help us do that.

## `inspect` Function

```php
/**
 * Inspect a value
 *
 * @param array $values
 * @return void
 */
function inspect($value)
{
  echo '<pre>';
  var_dump($value);
  echo '</pre>';
}
```

This will simply format and output whatever we pass in. We are not using `die` here so it won't stop the script. This way we can use it in a loop without it stopping the script after the first iteration. We can also use it multiple times in a script.

Let's say we were having an issue loading a view. We could use `inspect` to see what the `$view` variable is:

```php
function loadView($name)
{
  $viewPath = basePath("views/{$name}.view.php");

  inspect($viewPath);

  // Make sure path exists
  if (file_exists($viewPath)) {
    require $viewPath;
  } else {
    echo "View '{$name}' not found.";
  }
}
```

Now it will output the value of `$viewPath`:

```php
string(57) "/Users/bradtraversy/Sites/workopiadev/views/home.view.php"
```

## `inspectAndDie` Function

There will also be times where we want to dump a value and stop everything after it's called. We can create a function called `inspectAndDie` to do this:

```php
/**
 * Inspect a value and die
 *
 * @param mixed $value
 * @return void
 */
function inspectAndDie($value)
{
  echo '<pre>';
  die(var_dump($value));
  echo '</pre>';
}
```

Now we can use it in our code:

```php
function loadView($name)
{
  $viewPath = basePath("views/{$name}.view.php");

  inspectAndDie($viewPath);

  // Make sure path exists
  if (file_exists($viewPath)) {
    require $viewPath;
  } else {
    echo "View '{$name}' not found.";
  }
}
```

Now all you will see is the output and nothing else. This is useful for debugging and seeing what a variable is without having to do a bunch of `var_dump` and `die` statements.
