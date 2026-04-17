# Folder Refactor

Alright, so before we move on to create data and get into authentication, etc, I want to improve the infrastructure of the project a bit. We will be doing a couple big refactors throughout the project. Here, we will move some things around and then we're also going to be using something called namespaces in a little bit.

## `Framework` Folder

Right now, we have our classes like Database and Router right in the root directory. You can do that, but I prefer not to. Classes like this are part of our "framework". This may sound a little confusing because when you hear "framework" you think of something like Laravel or Symfony. But really, a framework is just a collection of code that you can use to build an application. So we are essentially building our own framework. It's just not for anyone else to use, it is for our own project.

What I want to do is have classes like this that you could basically re-use in any project into a folder called `Framework`. Now you could call this anything such as "Core" or "Lib" or whatever you want. I like Framework because that is really what it is. if you look at our project like a house, this is the framework and foundation of it.

Move your `Database.php` and `Router.php` files into a folder called `Framework`. Now we need to update the `require` statements in `index.php` to reflect the new location. Change them to look like this:

```php
require basePath('Framework/Database.php');
require basePath('Framework/Router.php');
```

We could technically move the `helpers.php` file into the `Framework` folder as well, but I like to keep it in the root directory. It also is not a class. The `Framework` folder is for classes. `routes` will also be kept in the root directory. You could put it in a folder like `config` if you want, but I like to keep it in the root.

## `App` Folder

So the Framework folder is for non-specific classes that you could use in any project. The `App` folder will be for our specific controllers, views, etc. This is the actual application.

Let's move `controllers` and `views` into a folder called `App`.

Once again, the site will break. We need to update a couple things.

First, in the `Framework/Router.php`, we need to update the `require` statement in the `route` method.

Change this line:

```php
require basePath($route['controller']);
```

To this:

```php
require basePath('App/' . $route['controller']);
```

Now in your `helpers.php` file, update the `loadView` and `loadPartial` functions to look in the `App` folder:

```php
// In the loadView function
$viewPath = basePath("App/views/{$name}.view.php");

// In the loadPartial function
$partialPath = basePath("App/views/partials/{$name}.php");
```

Now your application should be working again.

To me, this looks a lot cleaner. We have our framework and our application. The framework is the foundation and the application is the actual house.

In the next lesson, we will be using namespaces to make this even better.
