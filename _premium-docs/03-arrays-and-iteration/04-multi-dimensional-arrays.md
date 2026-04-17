# Muti-Dimensional Arrays

A multi-dimensional array is an array of arrays. It is common to fetch data from a database and store it in an array of associative arrays.

Let's start with something very simple:

```php
  $fruits = [
    ['Apple', 'Red'],
    ['Orange', 'Orange'],
    ['Banana', 'Yellow']
  ];
```

Each element in the `$fruits` array is an array itself. We can access the first fruit like this:

```php
  echo $fruits[0][0]; // Apple
```

We can access the color of the first fruit like this:

```php
  echo $fruits[0][1]; // Red
```

## Add a Fruit

We can add a fruit to the array of fruits like this:

```php
  $fruits[] = ['Grape', 'Purple'];

  echo '<pre>';
  print_r($fruits);
  echo '</pre>';
```

## Multi-Dimensional Associative Arrays

It is common to have an array of associative arrays. This is called a multi-dimensional array. You may fetch data from a database and store it in an array of associative arrays.

```php
$users = [
  ['name' => 'John', 'email' => 'john@gmail.com', 'password' => 'secret'],
  ['name' => 'Mary', 'email' => 'mary@gmail.com', 'password' => 'secret'],
  ['name' => 'Jane', 'email' => 'jane@gmail.com', 'password' => 'secret']
];

echo '<pre>';
print_r($users);
echo '</pre>';
```

If we want to access the email of the first user, we can do so like this:

```php
echo $users[0]['email']; // john@gmail
```

## Add a User

We can add a user to the array of users like this:

```php
$users[] = ['name' => 'Alex', 'email' => 'alex@gmail.com', 'password' => 'secret'];
```

So we don't have to specify the index. PHP will automatically add the user to the end of the array.

## Remove a User

We can remove users many different ways:

```php
// Remove the last user
array_pop($users);

// Remove the first user
array_shift($users);

// Remove a specific user
unset($users[1]);
```

We can use all of the standard array functions on an array of associative arrays.

## Count Users

We can count the number of users like this:

```php
echo count($users);
```
