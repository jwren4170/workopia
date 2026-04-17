# Show Single Listing

Now we are going to be working on the details/show page. This will show all the details of a single listing.

Each listing card has a link that goes to `/listings?id=1` where `1` is the ID of the listing. This is not the ideal way to pass data to a page but we will refactor this later so we can use a URL like `/listings/1` or even use some kind of slug.

Let's start by creating the route. Open `routes.php` and add this:

```php
$router->get('/listing', 'controllers/listings/show.php');
```

Create a new file in `controllers/listings` called `show.php`.

Here, we want to select a single listing from the database and pass it to the view. We can do this by using the `$_GET` superglobal to get the ID from the URL. We can then use the `fetch` method to get the listing from the database.

```php
$config = require basePath('config/db.php');
$db = new Database($config);

$id = $_GET['id'];

$listing = $db->query('SELECT * FROM listings WHERE id = ' . $id)->fetch();

inspect($listing);
```

So we actually have a couple issues here. You are probably seeing the 404 page first of all. The reason for this is because when we get the URL in the `public/index.php` file, we are doing it like this:

```php
$uri = $_SERVER['REQUEST_URI'];
```

This will give us the full URL including the query string. So if we go to `http://localhost:8888/listings?id=1`, `$uri` will be `/listings?id=1`. We need to remove the query string from the URL. We can do this by using the `parse_url` function and then getting the `path` key from the returned array.

```php
$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
```

Now `$uri` will be `/listings`.

## Prepared Statements

Now you may be seeing the listing from the database, however, the way that we are getting the ID from the URL is not secure. We are just using it directly in the query. This is a huge security risk and can lead to SQL injection attacks.

Instead, we need to use prepared statements. This will allow us to use placeholders in our query and then bind the actual value to the placeholder. This will sanitize the value and prevent SQL injection.

First, we need to update the `query` method in the `Database` class. Add the following:

```php
public function query($query, $params = [])
  {
    try {
      $sth = $this->conn->prepare($query);

      // Bind named parameters
      foreach ($params as $param => $value) {
        sth->bindValue(':' . $param, $value);
      }

      $sth->execute();
      return $sth;
    } catch (PDOException $e) {
      throw new Exception("Query execution failed: " . $e->getMessage());
    }
  }
```

We are adding a second parameter called `$params` which will be an array of parameters. We are then looping through the array and binding each parameter to the query.

Now in the controller, we can use this like so:

```php
$config = require basePath('config/db.php');
$db = new Database($config);

$id = $_GET['id'];

// Create params array
$params = [
  'id' => $id,
];

// Use a placeholder and add params array as second argument
$listing = $db->query('SELECT * FROM listings WHERE id = :id', $params)->fetch();

inspect($listing);
```

This is much more secure and will prevent SQL injection.

One other thing that I want to mention is that we are using the `fetch` method to get a single listing. This will return an object. When we got multiple listings, we used the `fetchAll` method which returned an array of objects. One thing I would like to do is actually create our own methods to fetch data, so that it is more flexible. We can refactor this in a little bit to do that.

In the next lesson, we will create the show view and display the listing data.
