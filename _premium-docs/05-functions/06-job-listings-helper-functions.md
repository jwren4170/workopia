# Job Listings Helper Functions

Now that you know how to create functions, let's create some helper functions for our job listings page.

### Format Salary

I want to create a function that will format the salary. It will take a salary as a parameter and return a formatted string with a `$` sign and commas and decimals.

If you remember back in the lesson on numbers and math functions, we have a function called `number_format` that will do this for us. We will use that function inside of our function.

Here is the code:

```php
function formatSalary($salary) {
  return '$' . number_format($salary, 2);
}
```

Put this below the `$jobListings` array/data. We want to keep our data at the top of the file and our functions below it.

This is a very simple function. It takes a salary as a parameter and returns a formatted string. We can use this function anywhere in our code.

Let's add it to the output by wrapping the `$job['salary']` variable in the function:

```php
<li class="mb-2">
  <strong>Salary:</strong> <?php echo formatSalary($job['salary']); ?>
</li>
```

Now you should see the salary formatted with a `$` sign and commas and decimals.

## Highlighted Tags

I want to create a function that will highlight selected tags/terms. It will take a string of tags along with a search term as parameters and return a string with the search term highlighted. We can use the `str_replace` function to replace the search term with the search term wrapped in a `<span>` tag with a class of `bg-yellow-200`.

Here is the code:

```php
function highlightTags($tags, $searchTerm) {
  $tagsArray = implode(', ', $tags);
  return str_replace($searchTerm, "<span class='bg-yellow-200'>$searchTerm</span>", $tagsArray);
}
```

Add this right below the `formatSalary` function.

Now we can implement it:

```php
 <?= (!empty($job['tags'])) ? '<li class="mb-2">
        <strong>Tags: </strong>' . highlightTags($job['tags'], 'Development') . '</li>' : '' ?>
```

We moved the `implode` function inside of the function. We can do this because we are only using it inside of the function. We are not using it anywhere else in our code.

So you can see how we're using PHP to make our little job listings app more dynamic. We are using functions to make our code more modular and reusable.
