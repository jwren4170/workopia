## Arrow Functions

Arrow functions were introduced in PHP 7.4 and are a special type of anonymous/lambda function. If you come from JavaScript land, you will be very familiar with these as they are very similar to the ES2015 arrow functions. They are created using the `fn` keyword, followed by a set of parentheses and a fat arrow (=>). They also have an implicit return, which means that the return keyword is not required. They have a very clear and concise syntax.

 One drawback compared to JS arrow functions is that you can not use curly braces with multiple statements. This style should only be used for simple functions that can be written on one line.

Let's start with a regular named function and then we will refactor it into an arrow function:

```php
function add($a, $b) {
	return $a + $b;
}
```

To turn this into an arrow function, there are a few steps:

- Make an anonymous function and set to a variable
- Replace `function` with just `fn`
- Add a fat arrow
- Remove the curly braces and return keyword

Here is the result:

```php
$add = fn ($a, $b) => $a + $b;
```

Arrow functions are made for one-liners. You may think we can do something like this if you are coming from JavaScript:

```php
$add = fn ($a, $b) => {
  return $a + $b;
};
```

This will give you an error. We can not have multiple lines.

## Arrow Functions For Callbacks

Arrow functions can also be used as callbacks. Let' use our `array_map` example:

```php
$numbers = [1, 2, 3, 4, 5];

$squaredNumbers = array_map(fn ($number) => $number * $number, $numbers);

print_r($squaredNumbers);

```

This code is more concise. We don't even need curly braces or a return keyword.


### Benefits of Arrow Functions

- Conciseness: Arrow functions provide a more compact syntax for simple functions.

- Readability: They make the code more concise and easier to read, especially for one-liner functions.

- Alignment with Modern JavaScript: If you're familiar with JavaScript, arrow functions in PHP will feel similar, simplifying code migration.

- Implicit Return: Arrow functions have implicit return, reducing the need for explicit return statements.

## formatSalary Refactor

Let's refactor the formatSalary function from our job listings:

Here is the original:

```php
function formatSalary($salary)
{
  return '$' . number_format($salary, 2);
}
```

We can make it an arrow function like this:

```php
$formatSalary = fn ($salary) => '$' . number_format($salary, 2);

```

Now you need to change where we call it in the template to use the variable with the `$`:

```php
 <li class="mb-2">
     <strong>Salary:</strong> <?= $formatSalary($job['salary']) ?>
 </li>
```