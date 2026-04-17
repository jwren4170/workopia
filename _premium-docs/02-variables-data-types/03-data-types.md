# Data Types

Every piece of data that you work with in PHP has a data type. A data type is a classification of the type of data that a variable or object can hold in computer programming. This isn't just in PHP. Every language has the concept of types. PHP has 8 primitive data types. We will go over each one in this lesson. We will also go over how to get the data type of a variable.

I also want to mention that PHP is a loosely typed language. This means that you do not have to declare the data type of a variable when you create it. You can change the data type of a variable after it has been set. This is different from a language like Java, which is a strongly typed language. In Java, you have to declare the data type of a variable when you create it and you can not change the data type after it has been set. There are pros and cons to both approaches, but just know that we do not have to declare the data type of a variable in PHP.

## `var_dump()` Function

The `var_dump()` function can also be used to get the data type as well as the value and length of a variable. You will use this quite a bit when debugging your code. It is similar to using `console.log()` in JavaScript. We do not have to echo it out, it will print to the screen automatically.

## `gettype()` Function

The `gettype()` function is used to get the data type of a variable. If you are familiar with JavaScript, it is similar to `typeof`. We will use `var_dump()` more often, but I wanted to show you this function as well. You do have to echo it out.

Let's look at all of the data types in PHP. I'm not going to use the HTML template for this lesson since we are mostly using `var_dump`, so we'll start with a blank file.

## String

A string is a sequence of characters. It can be letters, numbers, or symbols. Strings are always wrapped in quotes. You can use single or double quotes.

```php
  $name = 'Brad Traversy';
  $name2 = "John Doe";
  var_dump($name); // string(13) "Brad Traversy"
  echo getType($name); // string
```

## Integer

An integer is a whole number. It can be positive or negative. It can not have a decimal point.

```php
  $age = 35;
  var_dump($age); // int(35)
```

## Float

A float is a number with a decimal point. It can be positive or negative.

```php
  $rating = 4.5;
  var_dump($rating); // float(4.5)
```

You'll notice that when we print the type of a float, it says `double`. This is because PHP uses the `double` data type for floats. They are used interchangeably.

## Boolean

A boolean is a value that is either true or false. It is used for conditional statements.

```php
  $is_loaded = true;
  var_dump($is_loaded); // bool(true)
```

## Array

An array is a special variable that can hold multiple values. It is a collection of values. It can hold strings, integers, floats, booleans, and other arrays. Again, we will go over arrays and other types in more detail in other lessons.

```php
  $friends = array('John', 'Jane', 'Jill');
  var_dump($friends); // array(3) { [0]=> string(4) "John" [1]=> string(4) "Jane" [2]=> string(4) "Jill" }
```

## Object

An object is a collection of properties and methods. Objects are created using the `class` keyword. We will get into this much later, but here is a very simple example.

```php
$person = new stdClass();
echo gettype($person); // object
echo '<br>';
```

## Null

Null is a special data type that can only have one value: `null`. It is used to represent a variable with no value.

```php
  $car = null;
  var_dump($car); // NULL
```

## Resource

A resource is a special variable that holds a reference to an external resource. This is a simple example of a resource. `$file` is a resource that holds a reference to the `sample.txt` file. This will throw an error unless you create a file called `sample.txt` in the same directory as your PHP file. You don't have to do this, I just wanted to show you an example of a resource.

```php
  $file = fopen('sample.txt', 'r');
  echo gettype($file); // resource
```
