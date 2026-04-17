# Array Functions

In the last lesson, we looked at creating arrays and manipulating them using the element index. In this lesson, we will look at some of the built-in array functions that PHP provides. There are so many of these functions that it would be impossible to cover them all in this video, so I will cover some common ones. We will also use other ones throughout the course.

It is also important to know that some of these functions do something and then return a new array. Others do something and modify the original array. I will point out which ones return an array and we will set them to a variable.

Let's create a couple of arrays to work with.

```php
$ids = [10, 22, 15, 45, 67];
$users = ['user1', 'user2', 'user3'];
```

## count

The `count` function returns the number of items in an array. It takes one parameter, the array to count.

Let's output the number of items in each array. We will concatenate the number of items to a string so we can see the output.

```php
echo 'IDs: ' . count($ids) . ' Users: ' . count($users);
```

## sort

The `sort` function sorts an array by its values. It takes one parameter, the array to sort. This function modifies the original array.

```php
sort($ids); // [10, 15, 22, 45, 67]
sort($users); // ['user1', 'user2', 'user3']
```

## rsort

The `rsort` function sorts an array by its values in reverse order. It takes one parameter, the array to sort. This function modifies the original array.

```php
rsort($ids); // [67, 45, 22, 15, 10]
rsort($users); // ['user3', 'user2', 'user1']
```

## array_push

The `array_push` function adds one or more elements to the end of an array. It takes two parameters, the array to add to and the element(s) to add.

```php
array_push($ids, '75'); // [10, 22, 15, 45, 67, '75']
array_push($users, 'user4'); // ['user1', 'user2', 'user3', 'user4']
```

## array_pop

The `array_pop` function removes the last element from an array. It takes one parameter, the array to remove from.

```php
array_pop($ids); // [10, 22, 15, 45]
array_pop($users); // ['user1', 'user2']
```

## array_shift

The `array_shift` function removes the first element from an array. It takes one parameter, the array to remove from.

```php
array_shift($ids); // [22, 15, 45, 67]
array_shift($users); // ['user2', 'user3']
```

## array_unshift

The `array_unshift` function adds one or more elements to the beginning of an array. It takes two parameters, the array to add to and the element(s) to add.

```php
array_unshift($ids, '90'); // ['90', 10, 22, 15, 45, 67]
array_unshift($users, 'user5'); // ['user5', 'user1', 'user2', 'user3', 'user4']
```

## array_slice

The `array_slice` function returns a slice of an array. It takes three parameters, the array to slice, the starting index, and the length of the slice.

```php
$ids2 = array_slice($ids, 2, 3); // [15, 45, 67]
$users = array_slice($users, 1, 2); // ['user2', 'user3']
```

## array_splice

The `array_splice` function removes a portion of an array and replaces it with something else. It takes four parameters, the array to splice, the starting index, the length of the slice, and the replacement. It does not return a new array, it modifies the original array.

```php
array_splice($ids, 1, 1, 'New ID'); // [10, 'New ID', 15, 45, 67, 75, 90]
array_splice($users, 1, 1, 'New User'); // ['user1', 'New User', 'user3', 'user4', 'user5']
```

## array_reverse

The `array_reverse` function reverses the order of an array. It takes one parameter, the array to reverse. It will return a new array with the initial array reversed.

```php
$ids = array_reverse($ids); // [200, 100, 45, 15, 10]
$users = array_reverse($users); // ['userB', 'userA', 'user3', 'user2', 'user1']
```

## array_sum

The `array_sum` function returns the sum of the values in an array. It takes one parameter, the array to sum.

```php
array_sum($ids); // 467
```

## array_search

The `array_search` function searches an array for a given value and returns the corresponding key if successful. It takes two parameters, the array to search and the value to search for.

```php
array_search(67, $ids); // 2
array_search('user3', $users); // 2
```

## in_array

The `in_array` function checks if a value exists in an array. It takes two parameters, the value to search for and the array to search in. It returns `true` if the value is found and `false` if not. When printing, `true` is converted to `1` and `false` is converted to `0`.

```php
in_array(67, $ids); // 1
in_array('user3', $users); // 1
```

## explode

The `explode` function also splits a string into an array but gives you more control as you can specify a delimiter where you want to split. It takes two parameters, the delimiter to split on and the string to split.

```php
$string = 'Hello World';
$strToArr1 = explode(' ', $string); // ['Hello', 'World']
$strToArr2 = explode(',', 'user1,user2,user3'); // ['user1', 'user2', 'user3']
```

## implode

The `implode` function is the opposite of `explode`. It takes two parameters, the delimiter to join with and the array to join.

```php
$arrToStr1 = implode(', ', $users); // 'user1, user2, user3'
$arrToStr2 = implode(' ', $ids);  // '200 100 45 15 10'

```

There are a lot more array functions available in PHP. You can find them in the [PHP documentation](https://www.php.net/manual/en/ref.array.php).
