# Flash Message Methods

In this lesson we will add a couple methods to our `Session` class to set and get flash messages rather than using the `$_SESSION` superglobal within the controller.

Open the `Framework/Session.php` file and add the two following methods:

```php
/**
   * Set a flash message
   *
   * @param string $key
   * @param string $message
   * @return void
   */
 public static function setFlashMessage($key, $message)
 {
   self::set('flash_' . $key, $message);
 }

 /**
   * Get a flash message
   *
   * @param string $key
   * @param mixed $default
   * @return mixed
   */
 public static function getFlashMessage($key, $default = null)
 {
   $message = self::get('flash_' . $key, $default);
   self::clear('flash_' . $key); // Clear the flash message after retrieval
   return $message;
 }
 ```

 We pass a key into `setFlashMessage` and it will set it and prefix the key with `_flash`. When we get it it will call the `get` method, then clear with the `clear` method. It will then return the message.

 ## Using the Methods

Change the code to the following in `App/views/partials/message.php`:

```php
<?php

use Framework\Session;
?>

<?php $successMessage = Session::getFlashMessage('success_message'); ?>
<?php if ($successMessage !== null) : ?>
  <div class="message bg-green-100 p-3 my-3">
    <?= $successMessage ?>
  </div>
<?php endif; ?>

<?php $errorMessage = Session::getFlashMessage('error_message'); ?>
<?php if ($errorMessage !== null) : ?>
  <div class="message bg-red-100 p-3 my-3">
    <?= $errorMessage ?>
  </div>
<?php endif; ?>
```

It is doing the same thing, we just are not using the `$_SESSION` superglobal directly. We are using the `Session` class methods instead.

In the `ListingController@store`, change the manual `$_SESSION` set to the following:

```php
Session::set('success_message', 'Listing created successfully');
```

Change the delete authorization in `ListingController@destroy` to the following:

```php
 if (!Authorize::isOwner($listing->user_id)) {
      Session::set('error_message', 'You are not authorized to edit this listing');
      return redirect('/listings/' . $id);
    }
```

Also, set the success flash message to:

```php
Session::set('success_message', 'Listing deleted successfully');
```

In the update, change to the following:

```php
Session::set('success_message', 'Listing updated');
```
