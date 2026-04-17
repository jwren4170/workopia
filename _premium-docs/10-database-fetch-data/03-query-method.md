# `query` Method

Now that we have a class for our database and a connection, let's add a method to query the database. We will call it `query` and it will take in a SQL query string and return the results.

Open the `Database.php` file and add this method:

```php
/**
   * Query the database.
   *
   * @param string $query The SQL query to execute
   *
   * @return PDOStatement The PDO statement object.
   * @throws Exception If query execution fails.
   */
  public function query($query)
  {
    try {
      $sth = $this->conn->prepare($query);
      $sth->execute();
      return $sth;
    } catch (PDOException $e) {
      throw new Exception("Query execution failed: " . $e->getMessage());
    }
  }
}
```

This method will take in a query string that we pass into `prepare` and then execute it. It will return the statement object. If there is an error, it will throw an exception.

Now let's test it out. Open the `controllers/home.php` file and add this code:

```php
$config = require basePath('config/db.php');
$db = new Database($config);

$listings = $db->query('SELECT * FROM listings LIMIT 6')->fetchAll();

inspect($listings);

loadView('home');
```

Here we are creating a new instance of the `Database` class and passing in the config. Then we are calling the `query` method and passing in a SQL query. We are using `fetchAll` to get all the results and then passing that into `inspect` to see what we get.

You should see an array with 6 job listings. If you don't, make sure you have the database setup and the `listings` table with some data.

Delete the `inspect` line.

Now we need a way to pass the data to the view. In the next lesson, we will make it so that we can pass data through the `loadView` function.
