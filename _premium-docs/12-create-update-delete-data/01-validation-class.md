# Validation Class

Before we jump into the create form and store data in the database, I want to create a class for input validation. This will include static methods, because we will not need to instantiate this class. We will just call the methods statically.

We are going to have a new class/file in our `Framework` folder. Create a file at `Framework/Validation.php`. This will be a class that will validate form data.

Right now, we will create three methods:

- `string()`: Will validate a string meaning it will check if it's empty and if it's a string. We will also be able to pass a min and max length.
- `email()`: Will validate an email address.
- `match()`: Will check if two fields match, like a password and password confirmation.

## String Validation

Let's start with the `string` method. This will take three arguments, the value to check, an optional min and an optional max field.

```php
/**
   * Validate a string
   * @param string $value
   * @param int $min
   * @param int $max
   * @return bool
   */
  public static function string($value, $min = 1, $max = INF)
  {
    if (is_string($value)) {
      $value = trim($value);
      $length = strlen($value);
      return $length >= $min && $length <= $max;
    }

    return false;
  }
```

We are first checking if the value is actually a string and not something like an array. We are then trimming the value to remove any whitespace. We are then getting the length of the string and checking if it's between the min and max values. We set the default of the max value to `INF` which is the constant for infinity and the default of the min value to `1`.

If everything checks out, we return `true`, otherwise we return `false`.

## Email Validation

Now let's create a method to validate an email address. This will take one argument, the email address to validate. PHP makes this easy with the `filter_var` function rather than having to use a regular expression.

```php
/**
   * Validate an email address
   * @param string $value
   * @return bool
   */
  public static function email($value)
  {
    $value = trim($value);

    return filter_var($value, FILTER_VALIDATE_EMAIL);
  }
```

`filter_var` will filter a variable with a specific filter. This comes in handy and there are a bunch of things that you filter. `FILTER_VALIDATE_EMAIL` obviously filters email, but here are some others:

- FILTER_VALIDATE_BOOLEAN: Validates a boolean value (true/false).
- FILTER_VALIDATE_EMAIL: Validates an email address for proper format.
- FILTER_VALIDATE_INT: Validates an integer.
- FILTER_VALIDATE_FLOAT: Validates a floating-point number.
- FILTER_VALIDATE_IP: Validates an IP address (IPv4 or IPv6).
- FILTER_VALIDATE_URL: Validates a URL for proper format.
- FILTER_VALIDATE_MAC: Validates a MAC address.
- FILTER_VALIDATE_REGEXP: Validates against a regular expression.
- FILTER_VALIDATE_DOMAIN: Validates a domain name.
- FILTER_VALIDATE_COLOR: Validates a color code (hexadecimal or RGB).
- FILTER_VALIDATE_DATE: Validates a date string.
- FILTER_VALIDATE_TIME: Validates a time string.
- FILTER_VALIDATE_DATETIME: Validates a datetime string.
- FILTER_VALIDATE_BOOLEAN: Validates a boolean value.
- FILTER_VALIDATE_BOOLEAN: Validates a boolean value.
- FILTER_VALIDATE_BOOLEAN: Validates a boolean value.


## Match

Next we want a method to match two values. We will use this later in our registration form to make sure the password and password confirmation match. This will take two arguments, the two values to match.

```php
/**
   * Match a value against another value
   * @param string $value
   * @return bool
   */
  public static function match($value1, $value2)
  {
    $value1 = trim($value1);
    $value2 = trim($value2);

    return $value1 === $value2;
  }
```

## Testing

Let's test these out. We can just use our `HomeController@index` method for now.

At the top of the `index` method, add the following:

```php
inspect(Validation::string('', 1, 10));
```

Go to your homepage and you should see `false` because the string is empty.

Now try this:

```php
inspect(Validation::string('Hello', 1, 10));
```

You should see `true` because the string is between 1 and 10 characters.

Delete that line and test the email validation:

```php
inspect(Validation::email('test@test'));
```

This should give you `false` because it's not a valid email address.

Now try this:

```php
inspect(Validation::email('test@test.com'));
```

This should give you `true` because it's a valid email address.

Now test the match method:

```php
inspect(Validation::match('test', 'test'));
```

This should give you `true` because the two values match.

Now try this:

```php
inspect(Validation::match('test', 'test2'));
```

This should give you `false` because the two values do not match.

Alright, so our validation class is working. We will use this in upcoming lessons when we work with form data.
