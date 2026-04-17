# Delete Listings

Now we want to be able to delete listings. In the show view, you already have an edit and delete button from the theme HTML. You may notice that the delete is actually a form submit button. There is a little bit of a process to this since the browser can only make GET and POST requests. We will need to use a hidden form field to send the DELETE request.

Later on, we will make it so that only the user that created the listing can delete it. For now, we will just allow anyone to delete any listing.

Let's go into the `App/views/listings/show.view.php` file and add an action on the form tag:

```php
<form action="/listings/delete/<?= $listing->id; ?>" method="POST"></form>
```

We are passing the id in the URL so we can get it in the controller. Now let's create the route. Open `App/routes.php` and add this:

```php
$router->delete('/listings/delete/{id}', 'ListingController@destroy');
```

`destroy` is a method that we will create in the `ListingController`. We are also using a route parameter to get the id.

Now let's create the method in the controller. Open `App/Controllers/ListingController.php` and add this:

```php
 /*
  * Delete a listing
  *
  * @param array $params
  * @return void
*/
public function destroy($params)
{
  echo 'destroy';
}
```

This will not work yet because the delete form/button is making a POST request. We need to use a hidden form field to send the DELETE request. Let's go into the `App/views/listings/show.view.php` file and add a hidden field with the name of `_method` and a value of `DELETE`:

```php
<form action="/listings/delete/<?= $listing->id; ?>" method="POST">
  // add this
  <input type="hidden" name="_method" value="DELETE">
// ...
```

## Update The Router

Now we need to update the router to look for this. Open `Framework/Router.php` and edit the `route` method. Add this right above the foreach loop:

```php
// Check if the request is a POST and contains the _method parameter
if ($requestMethod === 'POST' && isset($_POST['_method'])) {
  // Override the request method with the value of _method
  $requestMethod = strtoupper($_POST['_method']);
}
```

This code is checking if the request is a POST and if it contains the `_method` parameter. If it does, we override the request method with the value of `_method`. So if the form is making a POST request, it will now be a DELETE request.

Now when you click the delete button, you should see `destroy` in the browser.

## Delete The Listing

Now we need to actually delete the listing. Before we can do that, we need to fetch it from the database.

In the `destroy` method in the `ListingController`, add this:

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

    inspectAndDie($listing);
  }
```

You should see the correct listing that matches the id in the URL.

Now add the following:

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

    redirect('/listings');
  }
```

Now when you click the delete button, you should be redirected to the listings page and the listing should be gone.

In the next lesson, we will look at creating flash messages to show when a listing is deleted.
