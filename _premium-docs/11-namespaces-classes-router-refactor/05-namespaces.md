# Namespaces

If you have ever used Laravel or Symphony, you have probably seen namespaces. They are a way to organize your code and prevent naming collisions. They are also a way to autoload classes without having to use `require` statements.

In Laravel, you have seen namespaces like `App\Http\Controllers`. This is a namespace that is used for controllers. The `App` namespace is the root namespace and the `Http\Controllers` namespace is a sub-namespace. We are going to be using namespaces in our project.

As an example to try and make namespaces a bit more clear, say that we have the file test.txt. A file with this name can exist in both directory say /home/brad and in /home/project, but two copies of test.txt cannot co-exist in the same directory. To access the test.txt file outside of the /home/brad directory, we need to prepend the directory name to the file name using the directory separator to get /home/brad/test.txt. This same principle extends to namespaces in the programming world.

## Adding Namespaces

We need to declare a namespace at the top of each file that we want to use a namespace in.

`Framework\Router`

Let's open the `Framework/Router.php` file and add a namespace to the top of the file:

```php
namespace Framework;
```

Anything in the Framework folder will use this namespace.

Now when we use the router, we need to use the namespace. Open your `public/index.php` file.

One way of using the namespace is by prefixing the class name with the namespace and a backslash:

```php
$router = new Framework\Router;
```

However, a better way to do this is to use the `use` keyword at the top of the file with the namespace name, which is what I want to do:

```php
use Framework\Router;
```

## `Framework\Database`

Open the `Framework/Database.php` file and add the namespace:

```php
namespace Framework;
```

Now, we need to make sure that where ever we use the `Database` class, we use the namespace. Right now, we are using the database class in a few places including the home controller and the listings controller. Later I will show you how we can use something called a `container` so that we can share a single instance of the database class throughout the application. For now, we will just instantiate a new instance of the database class in each controller.

Open the `App/controllers/home.php`, `App/controllers/listings/index.php` and `App/controllers/listings/show.php` files and add the namespace at the top of the file:

```php
use Framework\Database;
```

## PDO Issue

Now we get another error saying `Fatal error: Uncaught Error: Class "Framework\PDO" not found `.

This is because we are using the `PDO` class in the `Database` class which is now in the `Framework` namespace. So it is looking for `Framework/PDO`. We can fix this simply by adding this to the top of the file under the `namespace` declaration:

```php
use PDO;
```

Now your application should be working again.

## `App\Controllers` Namespace

We will be adding an `App` namespace to the controllers. We actually don't need to do this right now because we are not using them anywhere, but later, our controllers will be classes and we will need to use the namespace.
