# Edit Form

We almost have full CRUD functionality for listings. We just need to be able to update them now. Let's create an edit form for listings. Create a new file in `App/views/listings` called `edit.view.php`.

Let's just copy the entire `create.view.php` file and paste it into `edit.view.php`.

Change the following things:

- Change the form action to `/listings/<?= $listing->id; ?>`
- Add a hidden input with the name `_method` and value `PUT`
- Change the form heading to "Edit Job Listing"
- Change the submit button text to "Update Listing"
- Change all of the values from an array to object syntax. For example, change `$listing['title']` to `$listing->title`. This is because we will be passing the object from the database.
- Make the cancel button go to the show page for the listing. Change it to `href="/listings/<?= $listing->id; ?>"`

Open the `App/views/listings/show.view.php` file and add the listing id to the edit button link:

```php
  <a href="/listings/edit/<?= $listing->id; ?>" class="px-4 py-2 bg-blue-500 hover:bg-blue-600 text-white rounded">Edit</a>
```

Now let's create both the `GET` route to the show the edit page and the `PUT` route to update the listing.

```php
$router->get('/listings/edit/{id}', 'ListingController@edit');
$router->put('/listings/{id}', 'ListingController@update');
```

## `edit` Method

All the edit method does is fetch the listing from the database and pass it to the view. Open `App/Controllers/ListingController.php` and add this:

```php
 /*
   * Show the edit listing form
   *
   * @param array $params
   * @return void
   */
  public function edit($params)
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

    loadView('listings/edit', [
      'listing' => $listing,
    ]);
  }
```

In the next lesson, we will handle the update.
