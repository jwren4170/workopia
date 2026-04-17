# Anonymous Functions and Closures

Up to this point, we have been using named functions in PHP, which is definitely the most common type. However, we also have the option to use **anonymous functions**, also called **lambda functions**. There are a few different types of anonymous functions such as closures and callbacks. I will give you some simple examples of these.

## Anonymous Functions

Anonymous functions are created using the `function` keyword, followed by a set of parentheses, and then a set of curly braces. The parentheses are used to pass arguments to the function, and the curly braces are used to define the function body. The function body is the code that will be executed when the function is called.

One way to use an anonymous function is to assign it to a variable. The variable can then be used to call the function.

```php
$square = function($number) {
  return $number * $number;
};

$result = $square(5);

echo "The square of 5 is: " . $result;
```

Another way to use an anonymous function is to pass it as an argument to another function. This is a callback function. We will look at those in the next lesson.

## Closures and Outer Scope

Closures can be a bit confusing but in simple terms, a closure is a self-contained function that can capture and remember variables from its enclosing or outer scope. 

Remember, when we talked about scope, we have global scope and inside a function we have local scope. We couldn't access outer scope variables directly in a function. One thing I didn't show you in that lesson is that we can have functions defined within functions and they have their own scope. So it's not just global and local scope one level deep. There can be multiple levels. In some cases, you may need to access variables from the outer scope.

Closures can be created with anoymous functions and can access outer scoped variables using the `use` keyword. Let's look at an example:

```php
function createCounter() {
    $count = 0;

    // Define a closure that captures the $count variable
    $counter = function() use (&$count) {
        return ++$count;
    };

    return $counter;
}

// Create a counter function
$counter = createCounter();

// Use the counter function to increment and display the count
echo $counter() . "\n"; // Output: 1
echo $counter() . "\n"; // Output: 2
echo $counter() . "\n"; // Output: 3
```

- We define a function createCounter() that initializes a $count variable and then defines a closure called $counter.

- Inside the closure, we use the use keyword to capture the $count variable by reference (&$count). This means that the closure can modify the $count variable from its enclosing scope.

- We return the $counter closure from the createCounter() function.

- We create a counter function by calling createCounter() and assigning its return value to the $counter variable.

- We use the $counter closure to increment and display the count. Each time we call $counter(), it increments and returns the current count.