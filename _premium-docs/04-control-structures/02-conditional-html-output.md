# Conditionals & HTML Output

Sometimes you want to show or hide a UI element based on a condition. For example, you might want to show a button only if the user is logged in. Or you might want to show a message only if the user has not yet completed a certain task.

In this lesson, we will look at the same control structures that we looked at in the last lesson, except we will be using our template and we will show/hide elements based on a condition.

We'll start out with our template:

```php
<?php
$title = 'PHP From Scratch';
$heading = 'Welcome to the course';
$body = 'In this course, you will learn the fundamentals of the PHP language';
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script src="https://cdn.tailwindcss.com"></script>
  <title><?= $title ?></title>
</head>
<body class="bg-gray-100">
    <header class="bg-blue-500 text-white p-4">
        <div class="container mx-auto">
            <h1 class="text-3xl font-semibold"><?= $title ?></h1>
        </div>
    </header>
    <div class="container mx-auto p-4 mt-4">
        <div class="bg-white rounded-lg shadow-md p-6">
            <h2 class="text-2xl font-semibold mb-4"><?= $heading ?></h2>
            <p><?= $body ?></p>
        </div>
        <div class="bg-white rounded-lg shadow-md p-6 mt-6">
            <h2 class="text-2xl font-semibold mb-4">Output:</h2>
            <!-- Output -->
        </div>
    </div>
</body>
</html>
```

Let's add a new variable at the top:

```php
$isLoggedIn = true;
```

### If Statement

In the output area, let's add an `if` statement:

```php
<?php if($isLoggedIn): ?>
    <p>Welcome to the app!</p>
<?php endif; ?>
```

Now you should see the welcome message. Change `$isLoggedIn` to `false` and the message will disappear.

### If-Else Statement

Now let's say that we want to show a different message if the user is not logged in. We can do this with an `if-else` statement:

```php
<?php if($isLoggedIn): ?>
    <p>Welcome to the app!</p>
<?php else: ?>
    <p>Please log in</p>
<?php endif; ?>
```

Now if you change `$isLoggedIn` to `false`, you will see the 'Please log in' message.

### Nested If Statements

Now let's create another variable at the top:

```php
$name = 'John Doe';
```

If the user is not logged in, we will display a message that says 'Please log in'. If the user is logged in, but their name is not set, we will display a message that says 'Welcome to the app!'. If the user is logged in and their name is set, we will display a message that says 'Welcome' and their name.

```php
<?php if($isLoggedIn): ?>
    <?php if($name): ?>
        <p>Welcome <?= $name; ?></p>
    <?php else: ?>
        <p>Welcome to the app!</p>
    <?php endif; ?>
<?php else: ?>
    <p>Please log in</p>
<?php endif; ?>
```

Now change the values of `$isLoggedIn` and `$name` and you should see the different messages. Set `$name` to `null` and you should see the 'Welcome to the app!' message. Set `$isLoggedIn` to `false` and you should see the 'Please log in' message.

### If-Elseif-Else Statement

We can also do it with an `if-elseif-else` statement:

```php
<?php if($isLoggedIn && $name): ?>
    <p>Welcome <?= $name ?></p>
<?php elseif($isLoggedIn): ?>
    <p>Welcome to the app!</p>
<?php else: ?>
    <p>Please log in</p>
<?php endif; ?>
```
