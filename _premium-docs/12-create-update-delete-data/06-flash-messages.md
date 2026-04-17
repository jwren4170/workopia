## Flash Message

We want to show a flash message at certain points, for instance when a listing is deleted, added or updated. We can do this by setting a session variable and then checking for it in the view. If it exists, we will show the message and then unset the session variable.

Remember from the sessions lesson, in order to use sessions, we need to start the session at the top of the page. We will be using sessions a lot when we get into authentication, so let's start a session in the `public/index.php` file at the very top:

```php
session_start();
require __DIR__ . '/../vendor/autoload.php';
require __DIR__ . '/../helpers.php';

// ...
```

In the `destroy` method in the `ListingController`, create a session variable called `success_message`:

```php
public function destroy($params)
  {
    $id = $params['id'];
    $params = [
      'id' => $id,
    ];

    $listing = $this->db->query('SELECT * FROM listings WHERE id = :id', $params)->fetch();

    // Check if listing exists
    if (!$listing) {
      ErrorController::notFound('Listing not found');
      return;
    }

    $this->db->query('DELETE FROM listings WHERE id = :id', $params);

    // Add this line
    $_SESSION['success_message'] = 'Listing deleted successfully';

    redirect('/listings');
  }
```

Now in the `App/views/listings/index.view.php` file, add this under the `All Jobs` heading:

```php
<?php if (isset($_SESSION['success_message'])): ?>
  <div class="message bg-green-100 p-3 my-3">
    <?= $_SESSION['success_message']; ?>
  </div>
  <?php unset($_SESSION['success_message']); ?>
<?php endif; ?>
```

We are checking if the session variable exists and if it does, we are showing it in a green box. We are then unsetting the session variable so it doesn't show again.

Now you should see the message when you delete a listing.

## Message Partial

Let's create a partial that contains the message. Create a new file in `App/views/partials` called `message.view.php`.

We want to account for both success and error messages. We can do this by using `success_message` or `error_message` as the session variable name. Add this to the file:

```php
<?php if (isset($_SESSION['success_message'])) : ?>
  <div class="message bg-green-100 p-3 my-3">
    <?= $_SESSION['success_message']; ?>
  </div>
  <?php unset($_SESSION['success_message']); ?>
<?php endif; ?>

<?php if (isset($_SESSION['error_message'])) : ?>
  <div class="message bg-red-100 p-3 my-3">
    <?= $_SESSION['error_message']; ?>
  </div>
  <?php unset($_SESSION['error']); ?>
<?php endif; ?>
```

Now in your `App/views/listings/index.view.php` file, replace the message code with this:

```php
<?= loadPartial('message'); ?>
```

Now try another delete. You should see the message.

Let's add a message for when we create a listing as well. In the `store` method in the `ListingController`, add this:

```php
public function store() {
  // ... rest of the code
  $this->db->query($query, $newListingData);

  // Add this line
  $_SESSION['success_message'] = 'Listing created successfully';

  redirect('/listings');
}
```

Now when you create a listing, you should see the message.
