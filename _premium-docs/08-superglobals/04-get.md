# `$_GET` Superglobal

In PHP, the `$_GET` superglobal is a built-in array that allows you to retrieve data sent to your script via URL parameters (query strings) as well as data sent via the `GET` method. This could be data from a form, an HTTP/AJAX request, or a link click. In this lesson, we'll focus on retrieving data from the query string.

## What is a Query String?

A query string is a part of a URL that contains data to be passed to a web application. It is typically appended to the end of a URL and begins with a question mark `(?)`. The query string is made up of key-value pairs, where the key is the name of the parameter and the value is the data being passed. Multiple parameters can be passed by separating them with an ampersand `(&)`.

Here is an example of a URL with a query string:

```
https://example.com/search.php?query=php&sort=asc
```

In the above example, the query string contains two parameters: `query` and `sort`. The value of the `query` parameter is `php`, and the value of the `sort` parameter is `asc`.

## How to Access Query String Parameters

In PHP, the $\_GET superglobal is an associative array that contains the query string parameters. The keys of the array are the names of the parameters. Let's look at an example.

In your browser, add the following query string to the end of the URL in the address bar:

```php
?name=John&age=30
```

Depending on how your server is set up and what you named your files/folders, the root URL and page names may be different, but mine looks like this:

```
http://php-sandbox.test/06-superglobals/03-get?name=John&age=30
```

Now in your PHP file, add the following code:

```php
<?php

var_dump($_GET);
```

When you refresh the page, you should see the following output:

```php
array(2) {
  ["name"]=>
  string(4) "John"
  ["age"]=>
  string(2) "30"
}
```

As you can see, the `$_GET` superglobal is an associative array that contains the query string parameters. The keys of the array are the names of the parameters, and the values are the data being passed.

If you want to access the name parameter, you can do so like this:

```php
echo $_GET['name'];
```

Now, it is very important to note that you need to be careful when accessing query string parameters. You should never trust user input, and you should always sanitize and validate data before using it. We'll cover this more throughout the course.

## Check If Parameter Exists

Before accessing a query string parameter, you should always check to see if it exists. This is because if you try to access a parameter that doesn't exist, an error will be thrown. You can check to see if a parameter exists a couple different ways. You can use the `isset()` function or the null coalescing operator.

Take out the query string parameters from the URL and refresh the page. You should see something like this:

```php
Warning: Undefined array key "name" in *.php on line 4
```

So you want to do something like the following:

```php
if (isset($_GET['name'])) {
    echo $_GET['name'];
}
```

Now, if you refresh the page, you should see nothing. This is because the `name` parameter does not exist. If you add the `name` parameter back to the URL, you should see the value of the parameter.

You can also use the null coalescing operator like this:

```php
echo $_GET['name'] ?? '';
```

This will echo the name if there is one and an empty string if not.

Often times, we want to put that value in a variable of our own. We can do that a few ways.

Using the ternary operator with isset:

```php
$name = isset($_GET['name']) ? $_GET['name'] : 'Guest';
```

Using the null coalescing operator:

```php
$name = $_GET['name'] ?? null;
```


## Using `$_GET` To Filter Data

One of the most common uses of the `$_GET` superglobal is to filter data.

We don't have a database for our job listings, but we can still use the `$_GET` superglobal to filter the data in the array. Let's say we want to filter the jobs by location. We can add a query string parameter to the URL that looks like this:

```
http://localhost:8000?location=Chicago
```

Then, in our PHP file, we can access the `location` parameter and use it to filter the jobs.

Let's start by checking for the location param and setting a variable called `filteredJobListingsByLocation` to a function that will filter the jobs by location. We'll create the function in a minute.

```php
if (isset($_GET['location'])) {
  $location = $_GET['location'];

  // Filter job listings by the specified location
  $filteredJobListings = filterJobListingsByLocation($jobListings, $location);
} else {
  // If 'location' is not provided, display all job listings
  $filteredJobListings = $jobListings;
}
```

Now, above that, let's create the `filterJobListingsByLocation()` function. This function will take in the job listings array and the location to filter by. It will then loop through the job listings and return a new array that only contains jobs that match the specified location.

```php
// Filter job listings by location
function filterJobListingsByLocation($jobListings, $location)
{
  return array_filter($jobListings, function ($job) use ($location) {
    return strcasecmp($job['location'], $location) === 0;
  });
}
```

The function body is a bit complex, so let's break it down.

- First, we use the `array_filter()` function to loop through the job listings array and return a new array that only contains jobs that match the specified location. The `array_filter` function takes in an array and a callback function. The callback function is called for each element in the array. If the callback function returns `true`, the current value from the array is returned in the result array. If the callback function returns `false`, the current value from the array is not returned in the result array.
- The callback function uses the `use` keyword to import the `$location` variable from the parent scope into the function scope. This allows us to access the `$location` variable inside the callback function.
- In the callback function we compare the location of each job listing to the specified location. We use the `strcasecmp()` function to compare the strings case-insensitively. If the strings are equal, the function will return 0. So it only returns true if the location of the job listing matches the specified location.

Now, just change the `foreach` loop to loop through the filtered job listings instead of the original job listings.

```php
foreach ($filteredJobListings as $index => $job) {
  // ...
}
```

Put this in your URL:

```
http://localhost:8000?location=Chicago
```

You should only see the listing for the Chicago job.

We are not using the input in any database query or outputting it on the page so we don't really need to do much else in this situation, however, it is still a good idea to do a bit of validation. For example, we could check to see if the location is a valid location. If it is not, then we won't filter the job listings and we'll display all of them.

Add this under the job listing array:

```php

// List of valid locations
$validLocations = ['Chicago', 'San Francisco', 'New York', 'Seattle', 'Boston'];
```

Then, add this in the `if` statement:

```php
if (isset($_GET['location']) && in_array($_GET['location'], $validLocations)) {
  // ...
}
```
