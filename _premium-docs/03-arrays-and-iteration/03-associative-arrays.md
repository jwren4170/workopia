# Associative Arrays

Associative arrays are used to store key value pairs. The keys can be strings or numbers. The values can be any type. If you are coming from the JavaScript world, associative arrays are similar to object literals or dictionaries in Python.

```php
$user = [
  'name' => 'John',
  'email' => 'john@gmail.com',
  'password' => 'secret',
  'hobbies' => ['Tennis', 'Video Games']
];

var_dump($user);
```

We created an associative array with the `name`, `email`, `password` and `hobbies` keys. The `hobbies` key has an array as its value. So we can embed arrays inside arrays.

## Accessing Elements

We can access elements in an associative array using the key.

```php
echo $user['name']; // John
echo $user['email']; // john@gmail
```

If we try to access a key that doesn't exist, we will get a notice.

```php
echo $user['gender'];
```

## Adding Elements

We can add elements to an associative array by assigning a value to a new key.

```php
$user['address'] = '123 Main Street';
```

## Removing Elements

We can remove elements from an associative array using the `unset` function.

```php
unset($user['address']);
```
