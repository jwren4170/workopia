# Callback Functions

Another way to use an anonymous function is to pass it as an argument to another function. This is calles a callback function. It gets passed in and is called back later on within the function it was passed into.

There are many built in PHP functions that use callbacks. We have used some of these. For example, the array_map() function allows you to apply a callback function to each element of an array.

```php
$numbers = [1, 2, 3, 4, 5];

// Use array_map() with the callback function to square each number
$squaredNumbers = array_map(function ($number) {
  return $number * $number;
}, $numbers);

print_r($squaredNumbers);
```

We could also put the callback into a variable and pass that in.

```php
$numbers = [1, 2, 3, 4, 5];

// Define a callback function to square a number
$square = function ($number) {
  return $number * $number;
};

// Use array_map() with the callback function to square each number
$squaredNumbers = array_map(function ($number) {
  return $number * $number;
}, $numbers);

print_r($squaredNumbers);
```

Now, this is a pre-defined function, so we don't actually see the internal implementation of array_map() in this example, but it accepts your custom logic in the form of a callback function to process the array elements. 

Let's create our own function that accepts a callback:

```php
function applyCallback($callback, $value) {
    return $callback($value);
}

// Define a callback function to double a number
$double = function($number) {
    return $number * 2;
};

// Use our custom function to apply the callback
$result = applyCallback($double, 5); // Result: 10
```

In this example, we define a custom function `applyCallback()` that accepts a callback function and a value. It then invokes the callback function with the provided value and returns the result. We demonstrate this by defining a callback function $double that doubles a number and then using `applyCallback()` to apply the callback to the value `5`, resulting in `10`.

This is obviously a very simple example.

Key Points to Consider Around Callbacks:

- Callback functions provide a flexible way to customize the behavior of functions.
- You can define callbacks inline or as separate variables, promoting code reusability.
- Callbacks are widely used in PHP, especially in scenarios like array manipulation, event handling, and asynchronous programming.
- Understanding how to work with callbacks is essential for mastering PHP's functional programming capabilities.
