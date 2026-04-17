# Arrays In PHP

An array is a special type of variable that can hold multiple values. Arrays are useful for storing lists of data.

### Important points about arrays

I just want to quickly go over some key points of arrays in PHP:

- **Versatile Container:** Think of an array as a versatile container that can hold various pieces of information, like numbers, words, or even different types of data.

- **Ordered Collection:** It's like a numbered list where each item has its place, so you can always find them in a specific order. 

- **Mix and Match Data Types:** Arrays are flexible and can store different types of data in the same array, like numbers, text, and more, all together. IN many languages arrays have to all be the same type. They don't in PHP.

- **Easy Access:** You can access each piece of data by using a special number or name that identifies its location in the array, making it easy to retrieve and work with.

- **Useful for Grouping:** Arrays are helpful for grouping related data together, like a list of names, a set of numbers, or key-value pairs for storing information like names and ages.

- **Dynamic Size:** Arrays can grow or shrink as needed, allowing you to add or remove items as your program runs. Again in many other languages, you have to statically set the length of your array.

## Creating Arrays

There are two ways to create an array in PHP. The first is to use the `array` function. The `array` function takes any number of parameters, each of which is an item in the array.

```php
$names = array('John', 'Jane', 'Joe');
```

The second way to create an array is to use the square bracket syntax. This syntax is similar to JavaScript.

```php
$fruits = ['Apple', 'Orange', 'Banana'];
```

The second option is the main way that we will create arrays in this course.

## Outputting Arrays

Try and echo out the `$names` array:

```php
echo $names;
```

You will get an error. If you want to see all values in an array, you either have to loop over them or use a function like `var_dump` or `print_r`.

## Using `var_dump` With Arrays

The `var_dump` function can be used to display the contents of an array. It takes one parameter, the array to display.

```php
var_dump($names); // array(3) { [0]=> string(4) "John" [1]=> string(4) "Jane" [2]=> string(3) "Joe" }
var_dump($fruits); // array(3) { [0]=> string(5) "Apple" [1]=> string(6) "Orange" [2]=> string(6) "Banana" }
```

This is used a lot in debugging to see what is in an array.

You can also format the output by wrapping it in `<pre>` tags like this:

```php
 echo '<pre>';
 var_dump($names);
 echo '</pre>';
 ```

 I usually create a function that takes in a value/array and formats and outputs it like this. 

 You can also use the `die()` function to stop everything after outputting the array.

 I know we have not gone over functions yet, but let's create a simple function to format, output and die.

 ```php
function inspect($value) {
 echo '<pre>';
  var_dump($value);
  echo '</pre>';
  die();
}
```

Now use it on an array:

```pre
inspect($names);
```

Let's remove the `die()` though so we can use it on multiple values.

## print_r

The `print_r` function can also be used to display the contents of an array. It takes one parameter, the array to display.

```php
print_r($names); // Array ( [0] => John [1] => Jane [2] => Joe )
```

I don't really use this, but it is another way to show all of your array values.

## Accessing Array Items

You can access an item in an array by using the array variable name followed by square brackets containing the index of the item you want to access. The index is a number that represents the position of the item in the array. The first item in an array has an index of 0, the second item has an index of 1, and so on.

```php
echo $names[0]; // John
echo $fruits[2]; // Banana
```

## Changing Array Items

You can change an item in an array by using the array variable name followed by square brackets containing the index of the item you want to change.

```php
$names[0] = 'Mary';
$fruits[2] = 'Grape';
```

## Adding Items To An Array

There are a few ways to add items to an array. There is a function to do this, but I will get into array functions in the next lesson. You could assign the next index, which in this case would be 3, to the new item.

```php
$names[3] = 'Sue';
inspect($names);
```

However, this is not the best way to do this. You can use the `[]` syntax to add an item to the end of an array.

```php
$fruits[3] = 'Pineapple';
inspect($fruits);
```

## Removing Items From An Array

There are a few ways to remove items from an array. You could change the value to `null`, but that is not really removing it. There is a function to do this, but I will get into array functions in the next lesson. For now, we can use the `unset` function to remove an item from an array.

```php
unset($names[1]); // Removes Jane from the array
unset($fruits[2]); // Removes Pear from the array

inspect($names);
inspect($fruits);
```

## Mixing Data Types

Arrays in PHP do not have to all be of the same type like they do in some languages. Let's look at an example:

```php
$arr = [1, 'Hello', 3.14, true];
inspect($arr);
```

In this array we used an integer, a string, a float, and a boolean. This is probably not something that you would normally do, but it is possible.

In the next lesson, we will look at array functions.
