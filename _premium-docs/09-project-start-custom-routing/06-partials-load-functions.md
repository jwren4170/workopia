# Partials & Load Functions

We saw in the last lesson how we can include a view. The home view has everything in it including the `<html>` and `<body>` tags. This is not ideal. We want to be able to reuse the `<head>` and `<footer>` tags. Otherwise, we will have to copy and paste them into every view. One solution is to break them up into partials.

If you're coming from the JavaScript world, you can almost think of a partial as a component. It's a piece of code that can be reused in multiple places.

## Head Partial

In the `views` folder, create a new folder called `partials`. Inside of that folder, create a file called `head.php`. We are going to cut everything from the top of the file to the opening `<body>` tag, just above the header/nav and paste it into the `head.php` file. Then, we will include the `head.php` file in the `home.php` file.

Here is the code for the `head.php` file:

```php
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link rel="stylesheet" href="css/style.css" />
  <title>Workopia</title>
</head>

<body class="bg-gray-100">
```

Add this to the`home.view.php` file in its place:

```php
<?php require basePath('views/partials/head.php'); ?>
```

## Footer Partial

The footer is just the closing `</body>` and `</html>` tags. Grab them and paste them into a new file called `footer.php` in the `partials` folder. Then, include the `footer.php` file in the `home.view.php` file.

Here is the code for the `footer.php` file:

```php
</body>
</html>
```

Add this to the`home.view.php` file in its place:

```php
<?php require basePath('views/partials/footer.php'); ?>
```

## Header/Nav Partial

Now, lets get the navbar. Grab the `<header>` tag and paste it into a new file called `navbar.php` in the `partials` folder. Then, include the `navbar.php` file in the `home.view.php` file.

Here is the code for the `navbar.php` file:

```php
<!-- Nav -->
<header class="bg-blue-900 text-white p-4">
  <div class="container mx-auto flex justify-between items-center">
    <h1 class="text-3xl font-semibold">
      <a href="/">Workopia</a>
    </h1>
    <nav class="space-x-4">
      <a href="login.html" class="text-white hover:underline">Login</a>
      <a href="register.html" class="text-white hover:underline">Register</a>
      <a href="post-job.html" class="bg-yellow-500 hover:bg-yellow-600 text-black px-4 py-2 rounded hover:shadow-md transition duration-300"><i class="fa fa-edit"></i> Post a Job</a>
    </nav>
  </div>
</header>
```

Add this to the`home.view.php` file in its place:

```php
<?php require basePath('views/partials/navbar.php'); ?>
```

## Showcase Search Partial

Now let's get the showcase area with the search form. Grab the `<section>` tag and paste it into a new file called `showcase-search.php` in the `partials` folder. Then, include the `showcase-search.php` file in the `home.view.php` file.

Here is the code for the `showcase-search.php` file:

```php
<!-- Showcase -->
<section class="showcase relative bg-cover bg-center bg-no-repeat h-72 flex items-center">
  <div class="overlay"></div>
  <div class="container mx-auto text-center z-10">
    <h2 class="text-4xl text-white font-bold mb-4">Find Your Dream Job</h2>
    <form class="mb-4 block mx-5 md:mx-auto">
      <input type="text" placeholder="Keywords" class="w-full md:w-auto mb-2 px-4 py-2 focus:outline-none" />
      <input type="text" placeholder="Location" class="w-full md:w-auto mb-2 px-4 py-2 focus:outline-none" />
      <button class="w-full md:w-auto bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 focus:outline-none">
        <i class="fa fa-search"></i> Search
      </button>
    </form>
  </div>
</section>
```

Add this to the`home.view.php` file in its place:

```php
<?php require basePath('views/partials/showcase-search.php'); ?>
```

## Top Banner Partial

The last partial is the top banner. Grab the `<section>` tag and paste it into a new file called `top-banner.php` in the `partials` folder. Then, include the `top-banner.php` file in the `home.view.php` file.

Here is the code for the `top-banner.php` file:

```php
<!-- Top Banner -->
<section class="bg-blue-900 text-white py-6 text-center">
  <div class="container mx-auto">
    <h2 class="text-3xl font-semibold">Unlock Your Career Potential</h2>
    <p class="text-lg mt-2">
      Discover the perfect job opportunity for you.
    </p>
  </div>
</section>
```

Add this to the`home.view.php` file in its place:

```php
<?php require basePath('views/partials/top-banner.php'); ?>
```

## Bottom Banner Partial

We are going to create one more partial. This one will be for the bottom banner. Grab the `<section>` tag and paste it into a new file called `bottom-banner.php` in the `partials` folder. Then, include the `bottom-banner.php` file in the `home.view.php` file.

Here is the code for the `bottom-banner.php` file:

```php
<!-- Bottom Banner -->
<section class="container mx-auto my-6">
  <div class="bg-blue-800 text-white rounded p-4 flex items-center justify-between">
    <div>
      <h2 class="text-xl font-semibold">Looking to hire?</h2>
      <p class="text-gray-200 text-lg mt-2">
        Post your job listing now and find the perfect candidate.
      </p>
    </div>
    <a href="#" class="bg-yellow-500 hover:bg-yellow-600 text-black px-4 py-2 rounded hover:shadow-md transition duration-300">
      <i class="fa fa-edit"></i> Post a Job
    </a>
  </div>
</section>
```

Add this to the`home.view.php` file in its place:

```php
<?php require basePath('views/partials/bottom-banner.php'); ?>
```

## `loadView` and `loadPartial` Helper Functions

We are going to create two helper functions to make it easier to load views and partials. Open your `helpers.php` file and add the following functions:

```php
/**
 * Load a view
 *
 * @param string $name
 * @param array $data
 * @return void
 */
function loadView($name)
{
  require basePath("views/{$name}.view.php");
}

/**
 * Load a partial
 *
 * @param string $name
 * @param array $data
 * @return void
 */
function loadPartial($name)
{
  require basePath("views/partials/{$name}.php");
}
```

Now we don't have to use the `require` function anymore and we don't need to pass in the whole path, just the name of the view or partial.

In the `home.view.php` file, replace all of the `require` functions with the `loadPartial` function.

```php
<?php loadPartial('head'); ?>
<?php loadPartial('navbar'); ?>
<?php loadPartial('showcase-search'); ?>
<?php loadPartial('top-banner'); ?>

// Your html

<?php loadPartial('bottom-banner'); ?>
<?php loadPartial('footer'); ?>
```

In the `public/index.php` file, replace the `require` function with the `loadView` function.

```php
loadView('home');
```

This is a good example of how we can use functions to make our code more readable and easier to maintain.

## Check That File Paths Are Correct

Let's add a bit more code to the `loadView` and `loadPartial` functions. We will check to make sure that the file exists before we try to load it. If it doesn't exist, we will throw an error.

```php
function loadView($name)
{
  $viewPath = basePath("views/{$name}.view.php");

  // Make sure path exists
  if (file_exists($viewPath)) {
    require $viewPath;
  } else {
    echo "View '{$name}' not found.";
  }
}

/**
 * Load a partial
 *
 * @param string $name
 * @param array $data
 * @return void
 */
function loadPartial($name)
{
  $partialPath = basePath("views/partials/{$name}.php");

  // Make sure path exists
  if (file_exists($partialPath)) {
    require $partialPath;
  } else {
    echo "Partial '{$name}' not found.";
  }
}
```

## Commit Your Code

I think that this is a good place to make our first git commit. You should be making commits throughout the course. You can do it after every lesson if you would like or just when you feel like you have made a significant change. I won't be making commits on video outside of this one.

#### `.gitignore` file

Create a `.gitignore` file in the root of your project. This is where you list files and folders that you do NOT want to commit. Inside of the file, add the following:

```bash
/vendor
/node_modules
/config/database.php
.env
.vscode
.DS_Store
```

These are just some standard things that I like to add to my `.gitignore` file. You can add more if you would like.

- `vendor` and `node_modules` - Folders that will be created when we install packages. We don't want to commit those folders because they will be very large.
- `config/database.php` - Where we will store our database credentials. We don't want to commit that file because it will contain sensitive information.
- `.env` - I don't plan on needing a `.env`, but it is where you may store environment variables. We don't want to commit that file.
- `.vscode` - Where VS Code stores its settings.
- `.DS_Store` - A file that Mac OS creates.

Let's commit our code. Open your terminal and run the following commands:

```bash
git init
git add .
git commit -m "Initial commit - setup project structure and partials"
```
