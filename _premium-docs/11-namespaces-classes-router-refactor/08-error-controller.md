# Error Controller

Right now, we have a `controllers/error` folder with a `404.php` file. I don't want to do things that way so you. can completely delete the `error` folder.

Let's create a new file called `controllers/ErrorController.php` and add the following:

```php
namespace App\Controllers;

class ErrorController
{
  /*
     * 404 not found error
     *
     * @param string $message
     * @return void
     */
  public static function notFound($message = 'Resource Not Found')
  {
    http_response_code('404');
    loadView('error', [
      'status' => '404',
      'message' => $message,
    ]);
  }
}

```

The `notFound` method takes in a message. If left out, it will have a default message.

It loads a `404` response code and then loads a view and passes that status and message to it.

Notice we are using `static`. This is because there is no reason to instantiate more than one error object. So when we call a method, it will be with `::` instead of `->` We also do not need to instantiate the class.

## The View

In our views we have an error folder with `404.view.php` and `403.view.php`. This is not the best way to do this because then we'll have a file for every kind of error. Instead, let's have one view and just change the message based on the data passed in.

Delete the `error` folder and add an `error.view.php` file.

Add the following code:

```php
<?php loadPartial('head'); ?>
<?php loadPartial('navbar'); ?>
<?php loadPartial('top-banner'); ?>

<section>
  <div class="container mx-auto p-4 mt-4">
    <div class="text-center text-3xl mb-4 font-bold border border-gray-300 p-3"><?= $status ?> Error</div>
    <p class="text-center text-2xl mb-4">
      <?= $message; ?>
    </p>
  </div>
</section>

<?php loadPartial('footer'); ?>
```
Now we just load the status and message.

## The Router

In the router's `route()` method, we are loading the error view if there are no routes that match. We have a method called `error` and we called it with `$this->error()`.

Get rid of the whole `error` method and replace `$this->error()` with the following:

```php
ErrorController::notFound();
```

Now if you try going to let's say `/test`, you will getan eror because You did not use the namespace. 

Go to the top of the `Router.php` file and add the following:

```php
use App\Controllers\ErrorController;
```

Now you should see the 404 page.

## Other Errors

So for each error, you can add a method. Let's create one for `403 - unauthorized`. We will use this later with authentication.

In your `ErrorController.php`, add the following method:

```php
 /*
     * 403 unauthorized error
     *
     * @param string $message
     * @return void
     */
  public static function unauthorized($message = 'You are unauthorized to access this resource')
  {
    http_response_code('403');
    loadView('error', [
      'status' => '403',
      'message' => $message,
    ]);
  }
```


Alright, that's it. Let's move on to route params.

