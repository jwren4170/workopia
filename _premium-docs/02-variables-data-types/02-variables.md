# Variables

Variables are something that we have in virtually every programming language. Variables are used to store data. Think of them as a container that holds information. You can access that information at any time by calling the variable name.

In PHP, we have to use a dollar sign and then the variable name. For instance, if we want to store the name John, we would do something like this.

```php
  $name = 'John';
  echo $name; // John
```

## Naming Variables

There are a few rules for naming variables.

- They must be prefixed with a dollar sign.
- The variable name must start with a letter or an underscore.
- The variable name cannot start with a number.
- The variable name can only contain letters, numbers, and underscores.
- The variable name is case sensitive. So, `$name` and `$Name` are two different variables.

## Multiple Word Conventions

When we have multiple words in a variable name, we can use camel case or underscores. There is also something called pascal case, which is usually used for class names. 

Here are some examples:

```php
  // Underscore
  server_name = 'Server 1';

  // Camel Case
  serverName = 'Server 1';

  // Pascal Case
  ServerName = 'Server 1';
```

Which convention(s) you use is up to you. There is no strict rule, however, I would definitely say that it is important to stay consitient with what you use. We will be using camel case in this course except for class names, which will be Pascal case.

## Adding variables to our webpage

Let's create some variables for our website content:

```php
<?php
  $title = 'Learn PHP From Scratch';
  $heading = 'Welcome to the course';
  $body = 'In this course, you will learn the fundamentals of the PHP language';
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script src="https://cdn.tailwindcss.com"></script>
  <title><?php echo $title; ?></title>
</head>
<body class="bg-gray-100">
    <header class="bg-blue-500 text-white p-4">
        <div class="container mx-auto">
            <h1 class="text-3xl font-semibold"><?php echo $title; ?></h1>
        </div>
    </header>
    <div class="container mx-auto p-4 mt-4">
        <div class="bg-white rounded-lg shadow-md p-6">
            <h2 class="text-2xl font-semibold mb-4"><?php echo $heading?></h2>
            <p><?php echo $body; ?></p>
        </div>
    </div>
</body>
</html>
```

We created three variables that are holding strings. Again, I will talk about data types in the next lesson.

I used the `$title` variable in both the page title and the main title in the header. I also took the `<p>` tags out of the php and put them in the HTML. You want to stay consistent with your code.

## <?= ?> Shorthand

When echoing variables, we can use the `<?= ?>` shorthand. This is the same as `<?php echo ?>`. Let's change the code to use this shorthand.

```php
<?php
  $title = 'Learn PHP From Scratch';
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
    </div>
</body>
</html>
```

Some servers don't have this enabled by default, so if you get an error, you can enable it in the `php.ini` file. Just search for `short_open_tag` and set it to `On`. It's up to you if you want to use this shorthand or not. I personally like it. I think it looks much neater.

## Conclusion

See how convenient that is? If we were using any other language, we would need to use some kind of template engine or insert it into the DOM via JavaScript. With PHP, we can just use the variable name with no semi-colon or anything.

In JavaScript world, they are moving away from the Single Page Application (SPA) and going back to server side rendering with frameworks like Next.js, Remix and Nuxt.js. This is because it is much faster and more SEO friendly. With a SPA, you have to wait for the JavaScript to load and then you have to wait for the data to load. With server side rendering, you can just load the page and it's already there. This is something that PHP has done for decades.
