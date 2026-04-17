# Looping Through Arrays

One of the most useful things you can do with an array is loop through it. This allows you to perform the same action on each item in the array. There are many different ways to loop through an array. Let's look at a few.

## Using a `for` loop:

First, we will create a simple array of names:

```php
$names = ['John Doe', 'Matthew Thomas', 'Jose Ramirez', 'Mary Jane'];
```

Then in the HTML template, I will loop through and output each name in the array in an unordered list:

```php
<ul>
  <?php for ($i = 0; $i < count($names); $i++) : ?>
     <li><?php echo $names[$i]; ?></li>
   <?php endfor; ?>
</ul>
```

Here we are using a `for` loop to loop through the array. We are using the `count` function to get the number of items in the array. We are then using the `$i` variable to access each item in the array. You could do this with a `while` loop as well. However, these are not the best ways to loop through an array.

### Using a `foreach` loop

Using a `foreach` loop is the best way to loop over an array in my opinion. It is much cleaner. Let's look at an example:

```php
<ul class="my-6">
  <?php foreach($names as $name) : ?>
    <li><?php echo $name; ?></li>
  <?php endforeach; ?>
</ul>
```

We are using the `$name` variable to access each item in the array. The `$name` variable will be assigned the value of each item in the array as it loops through the array. This is cleaner than using `$names[$i]`.

## Using a `foreach` loop with the index

You can also use the `foreach` loop to get the index of each item in the array. Let's look at an example:

```php
foreach ($names as $index => $name) {
    echo $index . ': ' . $name . '<br>';
}
```

Here we are using the `$index` variable to get the index of each item in the array.

## Using a `foreach` loop with an associative array

You can also use the `foreach` loop to loop through an associative array. Let's look at an example:

```php
$users = [
  ['name' => 'John', 'email' => 'john@email.com'],
  ['name' => 'Jane', 'email' => 'jane@email.com'],
  ['name' => 'Joe', 'email' => 'joe@email.com'],
  ['name' => 'Mary', 'email' => 'mary@email.com']
];

foreach ($users as $user) {
  echo $user['name'] . ' - ' . $user['email'] . '<br>';
}
```

Let's output the user info in an unordered list:

```php
<ul>
  <?php foreach($users as $user) : ?>
    <li><?= $user['name'] . ' - ' . $user['email'] ?></li>
  <?php endforeach; ?>
</ul>
```

## Getting the keys in a `foreach` loop

You can also get the keys in a `foreach` loop. Remember, `$users` is an array of associative arrays. So we could use a nested `foreach` loop to get the keys and values:

```php
<ul class="mb-6">
  <?php foreach($users as $user) : ?>
    <?php foreach($user as $key => $value) : ?>
      <li><?= $key . ' - ' . $value ?></li>
    <?php endforeach; ?>
  <?php endforeach; ?>
</ul>
```
