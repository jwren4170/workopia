# Function Parameters

We saw how to create a very basic function in the last lesson. We also saw that a value can be returned from a function. In this lesson, we will learn how to have a function accept parameters. Parameters can be used to change the way a function works.

Let's create a function that adds two numbers together. If we want to create a function that adds two numbers, we need to be able to pass the two numbers to the function via parameters.

```php

function add($a, $b) {
    return $a + $b;
}

echo add(1, 2); // 3
echo add(5, 5); // 10
echo add(10, 20); // 30
```

In the above example, we created a function called `add` that takes two numbers as parameters. The function then returns the sum of the two numbers. We then call the function three times with different arguments.

## Parameter vs Argument

A lot of people get confused witht the terms "parameter" and "argument".

They are often used interchangeably, but there is a difference. A parameter is a variable in the function definition. An argument is the actual value that is passed to the function.

In the example above, `$a` and `$b` are parameters. `1` and `2` are arguments. I usually say parameter even when I mean argument. So just keep that in mind.

## Default Values

We can also provide default values for parameters. This means that if the argument is not passed to the function, the default value will be used instead.

```php
function sayHello($name = 'World') {
  return "Hello $name";
}

$greeting = sayHello();
$greeting2 = sayHello('Everyone');
echo $greeting;
echo '<br>';
echo $greeting2;
```

In the above example, we created a function called `sayHello` that takes one parameter. We set the default value to `World`. This means that if no argument is passed to the function, the default value of `World` will be used.

## Variable Arguments

We can also pass a variable number of arguments to a function. This is useful if we don't know how many arguments will be passed to the function. The ... is called the `splat` operator. If you are coming from JavaScript, it is similar to the `rest` operator.

```php
function addAll(...$numbers) {
  $total = 0;
  foreach ($numbers as $number) {
    $total += $number;
  }
  return $total;
}

echo '<br>';
echo addAll(1, 2, 3, 4, 5);
echo '<br>';
echo addAll(1, 2, 3, 4, 5, 6, 7, 8, 9, 10);
```

In the above example, we created a function called `addAll` that takes a variable number of arguments. We then loop through the arguments and add them together. We then return the total.

Now that we know how to create functions, I want to add to our job listings example. We'll do that in the next lesson.
