# Form Submission and Sanitation

In this lesson, we will start to hook up the create form, sanitize data and we will also display errors if there are any.

We have a `/listings/create` route that displays a form. Now we need a place for that form to submit to and that will be a `POST` request to the `/listings` route. We will create a `store` method in the `ListingController` that will handle this.

## Create Store Method

Let's start by creating a new method in the `ListingController` called `store`:

```php
public function store()
{
  echo 'Store method';
}
```

### Validation Namespace

We are going to be using the validation class, so at the very top of the file, under the `use Framework\Database`, add the following:

```php
use Framework\Validation;
```

Now we need to create the route. Open `routes.php` and add this:

```php
$router->post('/listings', 'ListingController@store');
```

## Create Form

In the `App/views/listings/create.view.php` file, add an action to the form:

```html
<form method="POST" action="/listings"></form>
```

Now when you submit, you should see the echo. Our form is now hooked up to the correct route and controller method.

We can get the data using the `$_POST` superglobal. Replace the echo with `var_dump($_POST)` and submit the form. You should see the data that was submitted.

We are going to put all the data into an array called `$newListingData`, however, I do not want just any `$_POST` data. I want to specify the fields that I want to get. There are a few ways to do this. We could loop through the `$_POST` data and check if the key is in an array of allowed fields. We could also use the `array_intersect_key` in combination with the `array_flip` function to do this. I am going to use the `array_intersect_key` method as it's cleaner. This function will return an array containing all the entries of `$_POST` that have keys that are also in the `$allowedFields` array. The `array_flip` function will flip the keys and values of an array. So if we have an array like this:

```php
$allowedFields = ['name', 'email'];
```

And we use `array_flip` on it, it will become:

```php
[
  'name' => 0,
  'email' => 1
]
```

So now we can use `array_intersect_key` to get the data from `$_POST` that has keys that are in the `$allowedFields` array.

So add the following to the top of the `store` method:

```php
public function store()
{
  $allowedFields = ['title', 'description', 'salary', 'tags', 'company', 'address', 'city', 'state', 'phone', 'email', 'requirements', 'benefits'];

  // Filter the POST data to include only allowed fields
  $newListingData = array_intersect_key($_POST, array_flip($allowedFields));

  inspect($newListingData);
}
```

Now when you submit the form, you should see an array with the data that was submitted.

#### Related User

We also need to add the `user_id`. Obviously, we don't have authentication yet, so let's just hardcode it to `1` or any id that is present in the `users` table.

```php
$newListingData['user_id'] = 1;
```

#### Sanitization

We are using PDO, which offers some protection against SQL injection, however, it is still a good idea to sanitize the data. There are a lot of ways to do this. I want to trim the data to remove any whitespace and also remove any HTML tags. There are a lot of different ways to do this. I am going to use `filter_var()`. This function allows us to filter a variable with a specified filter. We can use the `FILTER_SANITIZE_SPECIAL_CHARS` filter to remove any HTML tags. We can also use the `trim` function to remove whitespace from the beginning and end of the string.

Let's create a function called `sanitize` in the `helpers.php` file:

```php
/**
 * Sanitize data
 *
 * @param string $dirty
 * @return string
 */
function sanitize($dirty)
{
  return filter_var(trim($dirty), FILTER_SANITIZE_SPECIAL_CHARS);
}
```

Now we can use it in the `store` method. However, we want to use it on all of the data in the `$newListingData` array. We can use the `array_map` function to do this. This function will apply the callback function to each element of the array. So we can do this:

```php
// Sanitize the data
$newListingData = array_map('sanitize', $newListingData);
```

In the next lesson, we will implement the validation.