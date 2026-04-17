# Delete Authorization

Some people get confused when it comes to authentication vs authorization. Authentication is the process of verifying that a user is who they say they are. We have done that. A user can register and login and verify who they are. Authorization is the process of verifying that a user has access to certain resources. For example, if a user creates a listing, they should be the only one that can edit or delete it. We need to make sure that the user is authorized to edit or delete a listing.

We will need to edit some of the logic in the controllers and some of the UI in the view. We will do the controller logic first and make it so even if there were edit/delete buttons on the view, they would not work unless the user is authorized.

Open your `App/controllers/listingController.php` file.

## Save Session User On Create

Right now we have it so that the `user_id` is hardcoded to `1` on create/insert. Let's modify the `store` method to get the user id from the session and use that instead. First, add the `Session` class to the top of the file:

```php
use Framework\Session;
```

Then, in the `store` method, replace the `1` with `Session::get('user')['id']`:

```php
$newListingData['user_id'] = Session::get('user')['id'];
```

Let's go to the `destroy` method and add some logic to check if the user is authorized to delete the listing. We can do this by checking if the user ID in the session matches the user ID of the listing. If it does, we can delete it. If not, we can redirect back to the listing with an error message.

Make sure you are logged in or as soon as you click the delete button, you will be redirected because of our middleware.

Log in and go into the `destroy` method and inspect your ID. At the top of the method, add this:

```php
inspectAndDie(Session::get('user')['id']);
```

Go to any listing and click the delete button. You should see your ID. Now delete that line.

Right after we get the listing, let's check and make sure that the user ID matches the logged in user ID. If it does, we can delete the listing. If not, we can redirect back to the listing with an error message. Add this code:

```php
// Authorization
if (Session::get('user')['id'] != $listing->user_id) {
  $_SESSION['error_message'] = 'You are not authoirzed to delete this listing';return redirect("/listings/{$id}");
}
```

We are checking the session user id against the listing user id. If they do not match, we set the error message and redirect back to the listing. If they do match, we can delete the listing.

Now go to a listing that your user did not create and click the delete button. You should be redirected back to the listing with an error message.

Now try and delete one of your own. You would think it would work, but we have an issue. The session id is stored as a string and the listing user id is an integer, so they are not matching. We need to cast the session id to an integer. We could do that here, but I think a better idea to have this logic somewhere else for reusability. You could just use the `helpers.php` file, but this is more of a core function, so let's create a new file at `Framework/Authorization.php`.

We will make this a static class so we can call the methods without instantiating the class. Add this to the top of the file:

```php
namespace Framework;

use Framework\Session;
```

Then add this code:

```php
class Authorization
{
  /**
   * Check if the currently logged-in user owns a resource.
   *
   * @param int $resourceUserId
   * @return bool
   */
  public static function isOwner($resourceUserId)
  {
    $sessionUser = Session::get('user');

    if ($sessionUser !== null && isset($sessionUser['id'])) {
      $sessionUserId = (int) $sessionUser['id'];
      return $sessionUserId === $resourceUserId;
    }

    return false;
  }
}
```

We pass in the resource user id. We then get the session user and check if it is set and if the id is set. If it is, we cast the session user id to an integer and then check if it matches the resource user id. If it does, we return true. If not, we return false.

Back in the controller, add this to the top of the file:

```php
use Framework\Authorization;
```

Now, in the `destroy` method, we can just call this method and pass in the listing id:

```php
// Authorize user
if (!Authorization::isOwner($listing->user_id)) {
 $_SESSION['error_message'] = 'You are not authoirzed to delete this listing';
  return redirect('/listings/' . $id);
}
```

Now try and delete a listing that is not yours. It should not work. Then try and delete one of your own. It should work. We can now use this anywhere we need to check if a user is authorized to do something.

I would like to have some methods in our `Session` class to set and get flash messages. Let's do that next.
