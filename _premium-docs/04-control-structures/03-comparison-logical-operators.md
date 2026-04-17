# Comparison & Logical Operators

In this lesson, we will look at comparison and logical operators. These operators are used to compare values and to combine multiple conditions.

## Comparison Operators

Here is a list of comparison operators:

| Operator | Description              |
| -------- | ------------------------ |
| ==       | Equal to                 |
| ===      | Identical to             |
| !=       | Not equal to             |
| <>       | Not equal to             |
| !==      | Not identical to         |
| <        | Less than                |
| >        | Greater than             |
| <=       | Less than or equal to    |
| >=       | Greater than or equal to |

As you saw in the last lesson, we can use these in control structures like an if statement. What I want to do here is just show you some examples of how these work using `var_dump`. I'm using `var_dump` over `echo` because `echo` won't show 'true' or 'false' if it's a match or not, it will show '1' or '0'. `var_dump` will show 'true' or 'false'.

```php
$x = 10;
$y = '10';

var_dump($x == $y); // true

var_dump($x === $y); // false

var_dump($x != $y); // false

var_dump($x <> $y); // false

var_dump($x !== $y); // true

var_dump($x < $y); // false

var_dump($x > $y); // false

var_dump($x <= $y); // true

var_dump($x >= $y); // true
```

## Logical Operators

Logical operators are used to combine multiple conditions. Here is a list of logical operators:

| Operator | Description            |
| -------- | ---------------------- |
| and      | True if both are true  |
| or       | True if either is true |
| xor      | True if one is true    |
| &&       | True if both are true  |
| \|\|     | True if either is true |
| !        | True if it is not true |

Here are some examples to make it clear:

```php
$a = 10;
$b = 20;

var_dump($a == 10 and $b == 20); // true

var_dump($a == 10 or $b == 20); // true

var_dump($a == 10 xor $b == 20); // false

var_dump($a == 10 && $b == 20); // true

var_dump($a == 10 || $b == 20); // true

var_dump(!($x == 5)); // true

```
