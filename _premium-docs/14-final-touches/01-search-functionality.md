# Search Functionality

Now we want to make the search form on the homepage work. Open the `App/views/partials/search-showcase.php` file and make sure the form looks like this:

```html
<form method="GET" action="/listings/search" class="mb-4 block mx-5 md:mx-auto">
  <input
    type="text"
    name="keywords"
    placeholder="Keywords"
    class="w-full md:w-auto mb-2 px-4 py-2 focus:outline-none"
  />
  <input
    type="text"
    name="location"
    placeholder="Location"
    class="w-full md:w-auto mb-2 px-4 py-2 focus:outline-none"
  />
  <button
    class="w-full md:w-auto bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 focus:outline-none"
  >
    <i class="fa fa-search"></i> Search
  </button>
</form>
```

Take note of the form method and action. We are using GET because we want the form data to be in the URL. This is fine because it is not sensitive data and we are not submitting to the database or anything like that. We are also using the `/listings/search` route and using the `name` attribute on the two fields.

Now, let's create the route. Open `routes.php` and add this:

```php
$router->get('/listings/search', 'ListingController@search');
```

It is VERY important that you have your routes in the correct order. This needs to be above the `/listings/{id}` route. If it is below, it will look at `/listings/search` as an ID and not a route.

Here is what my routes file looks like right now:

```php
$router->get('/', 'HomeController@index');
$router->get('/listings/create', 'ListingController@create', ['auth']);
$router->get('/listings/edit/{id}', 'ListingController@edit', ['auth']);
$router->get('/listings/search', 'ListingController@search'); // Search route here
$router->get('/listings/{id}', 'ListingController@show');
$router->get('/listings', 'ListingController@index');

$router->post('/listings', 'ListingController@store', ['auth']);
$router->delete('/listings/delete/{id}', 'ListingController@destroy', ['auth']);
$router->put('/listings/{id}', 'ListingController@update', ['auth']);

$router->get('/auth/register', 'UserController@create', ['guest']);
$router->get('/auth/login', 'UserController@login', ['guest']);
$router->post('/auth/register', 'UserController@store', ['guest']);
$router->post('/auth/logout', 'UserController@logout', ['auth']);
$router->post('/auth/login', 'UserController@authenticate', ['guest']);
```

## `search` Method

Now we need to add the `search` method to the `ListingController`. Open `App/controllers/ListingController.php` and add this method:

```php
/*
   * Search listings
   *
   * @return void
   */
  public function search()
  {
    inspectAndDie($_GET);
  }
```

When you submit the form, you should see your values in the array. Now we can use these values to search the database.

We are going to be using a `LIKE` query to search the database. We will be using the `keywords` and `location` fields. We want the keywords to be in the title, description, tags or company name. We want the location to be in the city or state.

Let's start by getting the values from the `$_GET` array. Add the following in the `search` method:

```php
// Get the keywords and location from the search form
$keywords = isset($_GET['keywords']) ? trim($_GET['keywords']) : '';
$location = isset($_GET['location']) ? trim($_GET['location']) : '';
```

Let's create a basic query using the `LIKE` operator. Add the following:

```php
$query = "SELECT * FROM listings WHERE title LIKE '%Software%'";

$listings = $db->query($query)->fetchAll();

inspectAndDie($listings);
```

What this will do is get all listings where the title contains the word "Software". So if you have a title of "Software Engineer", it will be returned. The `%` is a wildcard. So if we had `%Software`, it would return any title that ends with "Software". If we had `Software%`, it would return any title that starts with "Software". If we had `%Software%`, it would return any title that contains "Software" anywhere in the title.

Now we want to bind the keywords and location to the query. Add the following:

```php
$query = "SELECT * FROM listings WHERE title LIKE :keywords";

$params = [
  'keywords' => "%{$keywords}%",
];

$listings = $this->db->query($query, $params)->fetchAll();

inspectAndDie($listings);
```

Type something in the keywords field and submit the form. You should see the listings that contain the keywords in the title.

We want this to match the description, tags and company name as well. We can do this by using the `OR` operator. Add the following:

```php
$query = "SELECT * FROM listings WHERE title LIKE :keywords OR description LIKE :keywords OR tags LIKE :keywords OR company LIKE :keywords";

$params = [
  'keywords' => "%{$keywords}%",
];

$listings = $this->db->query($query, $params)->fetchAll();

inspectAndDie($listings);
```

Now we want to add the location. We want to match the city or state. Add the following:

```php
$query = "SELECT * FROM listings WHERE (title LIKE :keywords OR description LIKE :keywords OR tags LIKE :keywords OR company LIKE :keywords) AND (city LIKE :location OR state LIKE :location)";

$params = [
  'keywords' => "%{$keywords}%",
  'location' => "%{$location}%",
];

$listings = $this->db->query($query, $params)->fetchAll();

inspectAndDie($listings);
```

Now our form is working, we just need to display the results. Replace the `inspectAndDie` call with the following:

```php
 loadView('/listings/index', [
  'listings' => $listings,
  'keywords' => $keywords,
  'location' => $location,
]);
```

Now it will load the `index` view and pass the listings, keywords and location to it. We can then use these variables in the view.

## View Heading

Right now the heading says `All Jobs`. Let's change that if it is a search. Open the `App/views/listings/index.php` file and replace the heading with this:

```php
<div class="text-center text-3xl mb-4 font-bold border border-gray-300 p-3">
  <?php if (isset($keywords)) : ?>
    Search Results for: <?= $keywords ?>
  <?php else : ?>
    All Jobs
  <?php endif; ?>
</div>
```

Now we have search functionality.
