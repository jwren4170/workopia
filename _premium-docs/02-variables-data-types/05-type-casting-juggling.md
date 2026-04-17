# Type Casting and Type Juggling

When dealing with types, there may be times when you need to convert a variable from one type to another. This is called `type casting`. PHP has two ways to do this. The first is called `implicit type casting`. This is when PHP automatically converts a variable from one type to another. This can also be called `type juggling`. The second is called `explicit type casting`. This is when you explicitly tell PHP to convert a variable from one type to another.

Now for beginners, I want to explain that this isn't something that you have to deal with a lot. I just want you to know how types can be changed both by PHP and by you. So if this seems confusing at this point, that's fine. I just thought this was a good place to discuss this since we are talking about types.

## Implicit Type Casting (Type Juggling)

We know that we have integers and strings. We looked at string concatenation in the last lesson. Well we can also perform mathematical operations with our variables. Let's add two numbers together and put the result in a variable called `$result`:

```php
$number1 = 5;
$number2 = 10;

$result = $number1 + $number2; // int 15
```

Simple enough. They are both integers so we get an integer back. You can check with:

```php
var_dump($result);
```

## Adding Numbers and Strings

What if we add a number and a string together?

```php
$number3 = '20';

$result = $number1 + $number3; // int (string to int) 25
```

This will give us the same result as if `$number3` were a number. PHP will automatically convert the string to a number and add them together. This is called `implicit type casting` or `type juggling`.

## Adding Strings

Try this:

```php
$result = $number3 + $number3; // int (string to int) 40
```

Since the string can be converted to an int, it will be and the result variable will be an int.

## Concatenating

If you have numbers inside of quotes and you want to concatenate then, you would use a period:

```php
$result = $number1 . $number2; // string (int to string) 520
```

Let's try something else:

```php
$fruit = 'apple';

$result = $fruit + $number1; // Error
```

In this case, we get an error because there is no way to convert the string `apple` to a number.

## Adding Numbers and Booleans

What if we add a number and a boolean together?

```php
$bool1 = true;
$bool2 = false;

$result = $number1 + $bool1; // int 6 (true to 1)
$result = $number1 + $bool2; // int 5 (false to 0)
```

In this case, PHP will convert the boolean to a number. `true` will be converted to `1` and `false` will be converted to `0`. So we get `6` and `5`.

## Adding Numbers and Null

What if we add a number and `null` together?

```php
$null = null;

$result = $number1 + $null; // int 5 (null to 0)
```

In this case, PHP will convert `null` to `0`. So we get `5`.

## Explicit Type Casting

We can also explicitly tell PHP to convert a variable from one type to another. There are a few ways to do this.

We can type cast by putting the type in parentheses in front of the variable:

```php
$result = (string) $number1; // int to string
$result = (int) $number3; // string to int
$result = (bool) $number1; // int to bool
```

Again, this is not something you will have to deal with a lot. I just wanted to show you how types can be changed both by PHP and by you.
