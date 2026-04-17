# Arithmetic Operators & Math Functions

I want to look at the arithmetic operators by doing some basic math and then look at some PHP core functions that deal with numbers and math.

Here are the basic arithmetic operators:

| Operator | Description    |
| -------- | -------------- |
| `+`      | Addition       |
| `-`      | Subtraction    |
| `*`      | Multiplication |
| `/`      | Division       |
| `%`      | Modulus        |

The only one that may not be clear is the modulus operator. The modulus operator returns the remainder of a division operation. I'll give you an example below. Let's look at all of the operators in action.

We have our HTML template with the `$output` variable set to `null`. We will set the `$output` variable to the result of the operation and then echo out the `$output` variable in the HTML template.

```php
$num1 = 20;
$num2 = 10;

echo "$num1 + $num2 = " . $num1 + $num2;  // 20 + 10 = 30
echo "$num1 - $num2 = " . $num1 - $num2;  // 20 - 10 = 10
echo "$num1 * $num2 = " . $num1 * $num2;  // 20 * 10 = 200
echo "$num1 / $num2 = " . $num1 / $num2;  // 20 / 10 = 2
echo "$num1 % $num2 = " . $num1 % $num2; // 20 % 10 = 0
```

## Appending Assignment Operators

We will get more into operators later, but I want to show you a quick shortcut. If you want to add a number to a variable, you can use the `+=` operator:

```php
$num3 = 10;
$num3 += 20; // Now $num3 is 30. It is the same as $num3 = $num3 + 20;
```

We can do this with subtraction, multiplication, and division as well:

```php
$num3 -=5;
$num3 *= 2;
$num3 /= 2;

```

## rand

The `rand` function generates a random integer. It takes two parameters, the minimum and maximum values to generate.

```php
rand(1, 10); // 7
```

## ceil

The `ceil` function rounds a number up to the next highest integer. It takes one parameter, the number to round.

```php
ceil(4.2); // 5
```

## floor

The `floor` function rounds a number down to the next lowest integer. It takes one parameter, the number to round.

```php
floor(4.2); // 4
```

## round

The `round` function rounds a number to the nearest integer. It takes one parameter, the number to round.

```php
round(4.2); // 4
round(4.6); // 5
```

## pi

The `pi` function returns the value of pi. It takes no parameters.

```php
pi(); // 3.1415926535898
```

## abs

The `abs` function returns the absolute value of a number. It takes one parameter, the number to check.

```php
abs(-4.2); // 4.2
```

## sqrt

The `sqrt` function returns the square root of a number. It takes one parameter, the number to check.

```php
sqrt(16); // 4
```

## max

The `max` function returns the highest value in an array. It takes one parameter, the array to check.

```php
max([1, 2, 3]); // 3
```

## min

The `min` function returns the lowest value in an array. It takes one parameter, the array to check.

```php
min([1, 2, 3]); // 1
```

### `number_format`

The `number_format` function formats a number with grouped thousands. It takes three parameters, the number to format, the number of decimal places, and the decimal point separator.

```php
number_format(1234567.891234, 2, '.', ','); // 1,234,567.89
```

This comes in handy when you are working with currency.

For more, visit the [PHP Math Functions](https://www.php.net/manual/en/ref.math.php) page in the PHP manual.
