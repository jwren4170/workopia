# Variable Scope

In this lesson, we're going to talk about something called 'scope'. Scope refers to the visibility of variables. In other words, where can we access a variable from?

## Global Scope

A variable that is defined outside of a function is said to be in the global scope. let's define a variable in the global scope:

```php
$name = 'Alice';
```

Let's see what happens when we try to access this variable from inside of a function:

```php
function sayHello() {
    echo 'Hello ' . $name; // Error
}
```

If you run this code, you will get an error. If you come from a JavaScript background, you may be surprised by this. JavaScript has lexical scoping, which means that functions can access variables from their containing scope automatically. PHP does not have lexical scoping. We have to explicitly tell the function that we want to use the `$name` variable from the global scope.

We can do this by using the `global` keyword:

```php
function sayHello() {
    global $name;
    echo 'Hello ' . $name;
}
```

Now you should see the output `Hello Alice`.

If I try and change the value of the `$name` variable inside of the function, it will change it in the local scope of the function, but it will not change the value of the `$name` variable in the global scope:

```php
function sayHello() {
    global $name;
    $name = 'Bob';
    echo 'Hello ' . $name;
}

sayHello(); // Hello Bob

echo $name; // Alice
```

## Local Scope

A variable that is defined inside of a function is said to be in the local scope. Let's define a variable called `$names` inside of a function and echo out the second name in the array:

```php
function sayGoodbye() {
  $names = ['John', 'Brad', 'Alice'];
  echo 'Goodbye ' . $names[1];
}

sayGoodbye(); // Goodbye Brad
```

If we try to access the `$names` variable from outside of the function, we will get an error:

```php
function sayHello() {
    $name = 'Alice';
    echo 'Hello ' . $name;
}

sayHello(); // Hello Alice

echo $names[1]; // Error
```

We get the error because the `$names` variable is in the local scope of the function. It is not accessible outside of the function.
