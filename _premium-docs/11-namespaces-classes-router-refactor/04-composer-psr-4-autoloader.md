## Composer & PSR-4 Autoloader

In the last lesson, we created a simple custom autoloader. It loads the files in the `Framework` folder and then we can instantiate the classes. However, this will not work if we have sub-folders and namespaces, which we will get into in the next lesson.

We could refactor the autoloader to handle this, but there is a standard called `PSR-4` that we can use. This is a standard for autoloading classes. It is used by many frameworks and libraries.

## Composer

PHP has a package manager called **Composer**. It is similar to **NPM **for Node.js. It allows us to install packages and libraries from the command line. It also has a built-in autoloader that we can use. This autoloader will follow the PSR-4 standard.

To install Composer, go to https://getcomposer.org/download/ and follow the instructions for your operating system.

Once installed, you can run `composer` in the terminal to see a list of commands.

## Composer Autoloader

Now we can use the Composer autoloader. First, we need to create a `composer.json` file in the root of our project. This file will contain our project information and dependencies. We can also configure our autoloader and namespaces here.

Add the following to the `composer.json` file`:

```json
{
  "name": "bradtraversy/workopia",
  "description": "Job listing application",
  "authors": [
    {
      "name": "Brad Traversy",
      "email": "traversymedia@gmail.com"
    }
  ],
  "autoload": {
    "psr-4": {
      "Framework\\": "Framework/",
      "App\\": "App/"
    }
  }
}
```

Replace the name and email with your own. The package name also needs to be unique. You can use your GitHub username and the project name.

In the `autoload` section, we are defining our namespaces and the folders they are in. So anything in the `Framework` folder will use the `Framework` namespace and anything in the `App` folder will use the `App` namespace. Again, we will get more into namespaces in the next video.

Now we can install the Composer autoloader by running `composer install` in the terminal. This will create a `vendor` folder and a `composer.lock` file. The `vendor` folder will contain the autoloader and any packages we install. You almost never want to edit anything in the `vendor` folder. If you are familiar with the JavaScript world, think of it as the `node_modules` folder.

## Include Autoloader

We need to include our autoloader.

In the `public/index.php` file, add the following to the top of the file:

```php
require __DIR__ . '/../vendor/autoload.php';
```

The `__DIR__` magic constant will give us the absolute path to the `public` folder. We then go up one directory and into the `vendor` folder and then include the `autoload.php` file. We should actually use this for the `helpers.php` file as well.

So these should be the first two lines after the opening PHP tag:

```php
require __DIR__ . '/../vendor/autoload.php';
require __DIR__ . '/../helpers.php';
```

Now if you go to your application, **it will be broken** because it is looking for the namespaces `Framework` and `App` and we have not created those yet. We will do that in the next lesson.
