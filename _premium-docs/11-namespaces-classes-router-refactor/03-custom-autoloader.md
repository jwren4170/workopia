# Custom Autoloader

So we have our `Framework` folder and this will be all classes. Right now we are manually requiring the files in our `public/index.php` file. This is fine for now, but as we add more classes, it will get messy.

We can use something called an autoloader to automatically require the files for us. We could use the `spl_autoload_register` function to do this. This function takes a callback function as an argument. This callback function will be called whenever a class is instantiated that hasn't been defined yet.

In your `public/index.php` file, replace the 2 require statements for the router and database files with this:

```php
spl_autoload_register(function ($class) {
  $path = base_path('Framework/' . $class . '.php');
  if (file_exists($path)) {
    require $path;
  }
});
```

What this will do is take the class name and then look for a file with that name in the `Framework` folder. So if we instantiate a `Database` class, it will look for a file called `Database.php` in the `Framework` folder. So if you created a new file and class called `Test`, it would look for `Framework/Test.php`. Just be sure to name your files and classes the same.

## PSR-4 Autoloader

Now this custom autoloader may be ok for now, but there is a standard called PSR-4 that we can use. This is a standard for autoloading classes. It is used by many frameworks and libraries. In the next lesson, we will use the Composer autoloader which follows this standard.
