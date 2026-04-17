# Pass Data To The View

Now that we can get data from the database from within the controller, we need a way to pass it to the view. We will do this by adding a second parameter to the `loadView` function.

Open the `helpers.php` file and change the `loadView` function to this:

```php
function loadView($name, $data = [])
{
  $viewPath = basePath("views/{$name}.view.php");

  // Make sure path exists
  if (file_exists($viewPath)) {
    extract($data);
    require $viewPath;
  } else {
    echo "View '{$name}' not found.";
  }
}
```

We will do the same with `loadPartial` so that we can pass data to partials as well.

```php
function loadPartial($name, $data = [])
{
  $partialPath = basePath("views/partials/{$name}.php");

  // Make sure path exists
  if (file_exists($partialPath)) {
    extract($data);
    require $partialPath;
  } else {
    echo "Partial '{$name}' not found.";
  }
}
```

We are passing in a `$data` parameter, which by default will be an empty array. We are then using the `extract` function to extract the data from the array and make it available as variables.

The `extract` function takes an associative array and converts the keys to variable names and the values to variable values. So if we had an array like this:

```php
$data = [
  'name' => 'Brad',
  'age' => 30
];
```

We could then use `$name` and `$age` as variables. So in our view, we could do this:

```php
<h1>Hello, <?= $name; ?></h1>
<p>You are <?= $age; ?> years old</p>
```

Let's go back to our `home.php` controller and pass the `$listings` variable to the view. Change the `loadView` line to this:

```php
loadView('home', [
  'listings' => $listings
]);
```

## Display Listings

Now we should have access to the `$listings` variable in our view. Let's replace the hard-coded listings with a loop that will loop through the listings and display them.

Open the `views/home.view.php` file and add the following code:

```php
<?php loadPartial('head'); ?>
<?php loadPartial('navbar'); ?>
<?php loadPartial('showcase-search'); ?>
<?php loadPartial('top-banner'); ?>

<!-- Job Listings -->
<section>
  <div class="container mx-auto p-4 mt-4">
    <div class="text-center text-3xl mb-4 font-bold border border-gray-300 p-3">Recent Jobs</div>
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
      <?php foreach ($listings as $listing) : ?>
        <div class="rounded-lg shadow-md bg-white">
          <div class="p-4">
            <h2 class="text-xl font-semibold"><?= $listing['title'] ?></h2>
            <p class="text-gray-700 text-lg mt-2">
              <?= $listing['description'] ?>
            </p>
            <ul class="my-4 bg-gray-100 p-4 rounded">
              <li class="mb-2"><strong>Salary:</strong> <?= $listing['salary'] ?></li>
              <li class="mb-2">
                <strong>Location:</strong> <?= $listing['city'] ?>, <?= $listing['state'] ?>
                <!-- <span class="text-xs bg-blue-500 text-white rounded-full px-2 py-1 ml-2">Local</span> -->
              </li>
              <li class="mb-2">
                <strong>Tags:</strong> <?= $listing['tags'] ?>
              </li>
            </ul>
            <a href="/listing?id=<?= $listing['id'] ?>" class="block w-full text-center px-5 py-2.5 shadow-sm rounded border text-base font-medium text-indigo-700 bg-indigo-100 hover:bg-indigo-200">
              Details
            </a>
          </div>
        </div>
      <?php endforeach; ?>
    </div>
    <a href="/listings" class="block text-xl text-center">
      <i class="fa fa-arrow-alt-circle-right"></i>
      Show All Jobs
    </a>
</section>

<?php loadPartial('bottom-banner'); ?>
<?php loadPartial('footer'); ?>
```

Now you should see the listings from your database. Cool, right?

## Default Fetch Mode

Right now, when we get our data, it comes as an associative array. So when we want to show a field, we use this syntax:

```php
<?= $listing['title'] ?>
```

I prefer to use objects instead of arrays. They use this syntax:

```php
<?= $listing->title ?>
```

We can change this by setting the default fetch mode to `PDO::FETCH_OBJ`. This will return the data as an object instead of an array.

IF you want to do this, go to your `Database.php` file and add this to your `$options` array in the `__construct` method:

```php
$options = [
      PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ,
      PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    ];
```

If you go back to the homepage, it will break. You need to update the syntax in your view to use the object syntax:

```php
<?php loadPartial('head'); ?>
<?php loadPartial('navbar'); ?>
<?php loadPartial('showcase-search'); ?>
<?php loadPartial('top-banner'); ?>

<!-- Job Listings -->
<section>
  <div class="container mx-auto p-4 mt-4">
    <div class="text-center text-3xl mb-4 font-bold border border-gray-300 p-3">Recent Jobs</div>
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
      <?php foreach ($listings as $listing) : ?>
        <div class="rounded-lg shadow-md bg-white">
          <div class="p-4">
            <h2 class="text-xl font-semibold"><?= $listing->title ?></h2>
            <p class="text-gray-700 text-lg mt-2">
              <?= $listing->description ?>
            </p>
            <ul class="my-4 bg-gray-100 p-4 rounded">
              <li class="mb-2"><strong>Salary:</strong> <?= $listing->salary ?></li>
              <li class="mb-2">
                <strong>Location:</strong> <?= $listing->city ?>, <?= $listing->state ?>
                <!-- <span class="text-xs bg-blue-500 text-white rounded-full px-2 py-1 ml-2">Local</span> -->
              </li>
              <li class="mb-2">
                <strong>Tags:</strong> <?= $listing->tags ?>
              </li>
            </ul>
            <a href="/listing?id=<?= $listing->id ?>" class="block w-full text-center px-5 py-2.5 shadow-sm rounded border text-base font-medium text-indigo-700 bg-indigo-100 hover:bg-indigo-200">
              Details
            </a>
          </div>
        </div>
      <?php endforeach; ?>
    </div>
    <a href="/listings" class="block text-xl text-center">
      <i class="fa fa-arrow-alt-circle-right"></i>
      Show All Jobs
    </a>
</section>

<?php loadPartial('bottom-banner'); ?>
<?php loadPartial('footer'); ?>
```

## Listings Page

The listings page will be very similar except we will loop through all the listings and display them. Let's go to the `listings.php` controller and change the `loadView` line to this:

```php
$config = require basePath('config/db.php');
$db = new Database($config);

$listings = $db->query('SELECT * FROM listings')->fetchAll();

loadView('listings/index', [
  'listings' => $listings
]);
```

Now in the `views/listings/index.view.php` file, we can loop through the listings and display them:

```php
<?php loadPartial('head'); ?>
<?php loadPartial('navbar'); ?>
<?php loadPartial('top-banner'); ?>

<!-- Job Listings -->
<section>
  <div class="container mx-auto p-4 mt-4">
    <div class="text-center text-3xl mb-4 font-bold border border-gray-300 p-3">All Jobs</div>
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
      <?php foreach ($listings as $listing) : ?>
        <div class="rounded-lg shadow-md bg-white">
          <div class="p-4">
            <h2 class="text-xl font-semibold"><?= $listing->title ?></h2>
            <p class="text-gray-700 text-lg mt-2">
              <?= $listing->description ?>
            </p>
            <ul class="my-4 bg-gray-100 p-4 rounded">
              <li class="mb-2"><strong>Salary:</strong> <?= $listing->salary ?></li>
              <li class="mb-2">
                <strong>Location:</strong> <?= $listing->city ?>, <?= $listing->state ?>
                <!-- <span class="text-xs bg-blue-500 text-white rounded-full px-2 py-1 ml-2">Local</span> -->
              </li>
              <li class="mb-2">
                <strong>Tags:</strong> <?= $listing->tags ?>
              </li>
            </ul>
            <a href="/listing?id=<?= $listing->id ?>" class="block w-full text-center px-5 py-2.5 shadow-sm rounded border text-base font-medium text-indigo-700 bg-indigo-100 hover:bg-indigo-200">
              Details
            </a>
          </div>
        </div>
      <?php endforeach; ?>
    </div>
</section>

<?php loadPartial('bottom-banner'); ?>
<?php loadPartial('footer'); ?>
```

## Salary Formatting

Remember back a bunch of sections ago, we created a function to format the salary? Let's use that in our listings.

Add the following function to the `helpers.php` file:

```php
/**
 * Format Salary
 *
 * @param string $salary
 * @return string $formattedSalary
 */
function formatSalary($salary)
{
  return '$' . number_format(floatval($salary));
}
```

We did have to cast it from a string to a float because the `number_format` function requires a float and salary is stored as a string in the database.

Now in both the `home.view.php` and `listings/index.view.php` files, we can use this function to format the salary:

```php
<?= formatSalary($listing->salary) ?>
```
