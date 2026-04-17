# Database Class & Connection

In the database section, we looked at how to use `PDO`, which is a PHP extension that allows us to connect to and query a database. We also looked at how to use prepared statements to prevent SQL injection attacks. We will be using `PDO` in this project, but we will be creating a class to make it easier to use. This will include connecting to the database, preparing statements, binding values, returning results and more.

Create a new file in the root called `Database.php`. This will be our database class. We will be moving some of these files out of the root soon, but for now, we will keep it simple.

In our class, we will have a property to store the connection to the database. That way, we can use it in any method in the class. We will also have a constructor that will connect to the database. We will use the `__construct` magic method to do this. This method will be called automatically when we instantiate the class.

The constructor will take in a config array with the database credentials. We will then use `PDO` to connect to the database and store the connection in the `$conn` property.

Add this to the `Database.php` file:

```php
<?php
class Database
{

  public $conn;

  /**
   * Constructor for Database class
   *
   * @param array $config The database configuration array
   */
  public function __construct($config)
  {
    $dsn = "mysql:host={$config['host']};port={$config['port']};dbname={$config['dbname']}";

    $options = [
      PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
      PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
    ];

    try {
      $this->conn = new PDO($dsn, $config['username'], $config['password'], $options);
    } catch (PDOException $e) {
      throw new Exception("Database connection failed: " . $e->getMessage());
    }
  }
}
```

This should look pretty familiar. We did this in the database section, we just did it in a procedural way. Now we are doing it in a class.

We create the DSN string using the config array. We then create an options array that will set the error mode to exception. This will throw an exception if there is an error connecting to the database. We then try to connect to the database and store the connection in the `$conn` property. If there is an error, we throw an exception.

Let's create our config file. Create a folder called `config` and a file called `db.php` inside of it. Add this to the file:

```php
return [
  'host' => 'localhost',
  'port' => 3306,
  'dbname' => 'dev',
  'username' => 'root',
  'password' => ''
];
```

Of course, use your own credentials.

Now, let's go into our `public/index.php` file and require the `Database.php` file and instantiate the class. We will then use the `inspect` helper to see if we have a connection. Add this to the bottom of the `index.php` file:

```php
require basePath('Database.php');

$config = require basePath('config/db.php');

$db = new Database($config);

inspect($db->conn);
```

Now you should see something like this:

```php
object(Database)#1 (1) {
  ["conn"]=>
  object(PDO)#2 (0) {
  }
}
```

If you see an error, make sure your credentials are correct. If you don't see an error, temporarily change something in your config file and you should see an error.

Delete everything we just added to the `public/index.php` file except for the require of the database class. We just wanted to test the connection. In the next lesson, we will create a method to query the database.
