# Update Authorization

In the last lesson, we made it so only owners can delete their listings. Now we need to make it so not only can owners do an update, but only owners should be able to see the edit form for their listings.

Let's do the actual update first so that we can test it and then we will block the edit form.

Open the `ListingsController` and add this to the `update` method right after fetching the listing abd checking if it exists:

```php
  // Authorization
  if (!Authorization::isOwner($listing->user_id)) {
    Session::setFlashMessage('error_message', 'You are not authoirzed to update this listing');
    return redirect('/listings/' . $listing->id);
  }
```

Now if you click edit and submit the form on a listing that is not yours, you should be redirected back to the listing with an error message.

Now, let's block the edit form. Go to the `edit` method of the `ListingsController` and add this right after fetching the listing:

```php
  // Authorization
  if (!Authorization::isOwner($listing->user_id)) {
    Session::setFlashMessage('error_message', 'You are not authoirzed to update this listing');
    return redirect('/listings/' . $listing->id);
  }
```

Now as soon as you click edit on a listing that is not yours, you should be redirected back to the listing with an error message.

You should be able to edit your own listings.

## Hiding The Buttons

Now we need to hide the edit and delete buttons on the view page if the listing is not yours. Open the `views/listings/show.view.php` file and wrap the div that surrounds the buttons with this:

```php
<?php if (Framework\Authorization::isOwner($listing->user_id)) : ?>
  <div class="flex space-x-4 ml-4">
    <a href="/listings/edit/<?= $listing->id; ?>" class="px-4 py-2 bg-blue-500 hover:bg-blue-600 text-white rounded">Edit</a>
    <!-- Delete Form -->
    <form method="POST" action="/listings/delete/<?= $listing->id; ?>">
      <input type="hidden" name="_method" value="DELETE">
      <button type="submit" class="px-4 py-2 bg-red-500 hover:bg-red-600 text-white rounded">Delete</button>
    </form>
    <!-- End Delete Form -->
  </div>
<?php endif; ?>
```

We are just using our `isOwner` method to check if the listing belongs to the logged in user. If it does, we show the buttons.

Now only the listing owner can manage the listing.
