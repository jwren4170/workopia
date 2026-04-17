# Connect with PDO

In this lesson, we will connect to a database using **PDO**, which stands for PHP Data Objects. PDO is a PHP extension that provides a consistent interface for interacting with databases. It is a better alternative to the `mysql_*` functions that were used back in the day. You can use it with other databases as well, such as PostGreSQL, SQLite, and Oracle.

I just want to mention that the code that we write in this section will not be the best code. My goal is to get you familiar with PDO and using the database. In our final project, we will structure our code like a professional application.

## PDO for Security

PDO is a better alternative to the `mysql_*` functions because it provides a way to use prepared statements. Prepared statements allow us to use placeholders in our SQL statement and then pass the values for those placeholders in a separate array. This way, the values are not mixed in with the SQL statement and cannot be used to change the SQL statement. This prevents SQL injection attacks. We'll talk more about this later.

You can create a totally new directory for this stuff or you can work in the sandbox. I'm just using the sandbox so that you guys have this code available to you in an organized way. I'm going to open the `php-sandbox/07-database/01-connect-pdo/database.php` file and I am going to add my database credentials in variables for easy access:

```php
// Database configuration
$host = 'localhost';
$port = 3306;
$dbName = 'blog';
$username = 'root';
$password = '';
```

Make sure that you use your correct credentials. When in a local environment, the host is usually `localhost`. The default port for MySQL is `3306`.

## DSN (Data Source Name)

The first thing we need to do is create a `DSN`, which stands for `Data Source Name`. This is a string that contains the information required to connect to the database. This DSN gets passed to the PDO constructor along with the username and password. The DSN contains the following information:

- The database driver: `mysql`, `pgsql`, `sqlite`, etc.
- The database host: `localhost`, `
- The database name: `blog`
- The database charset: `utf8`
- The database port: `3306`

Let's create the DSN:

```php
// Connection string (DSN)
$dsn = "mysql:host={$host};port={$port};dbname={$dbName};charset=utf8";
```

## PDO Instance

Now that we have the DSN, we can create a new PDO instance. This is the object that we will use to interact with the database. We will pass the DSN, username, and password to the constructor:

```php
  // Create a PDO instance
  $pdo = new PDO($dsn, $username, $password);
```

## Error Mode

By default, PDO will not throw an exception if there is an error. Instead, it will return `false`. We can change this behavior by setting the error mode to `PDO::ERRMODE_EXCEPTION`. This will throw an exception if there is an error. We can do this by calling the `setAttribute()` method on the PDO instance. We should also put this code inside a try/catch block so that we can catch any exceptions that are thrown:

```php
try {
  // Create a PDO instance
  $pdo = new PDO($dsn, $username, $password);

  // Set PDO to throw exceptions on error
  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  // Set to fetch associative array
  $db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

  echo "Database Connected...";

  // You are now connected to the database, and $pdo contains the connection object

  // You can perform database operations here

} catch (PDOException $e) {
  // If there is an error with the connection, catch it here
  echo "Connection failed: " . $e->getMessage();
}
```

If you run the file, you should see `Database Connected...`

If something is wrong, you will see the error message. If you don't see an error message, change something like the database name to see if you get an error.

Delete the `echo` statement and the comments under it. Otherwise you will see the message every time you run the file. We are going to be using this same database.php file in the next lesson.

That's it! we are now connected to our database using PDO. In the next lesson, we will learn how to query the database.
