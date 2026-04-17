# Update Listing

We have our edit form. Now we need to make it work and update the listing in the database.

You should have a route in your `routes.php` file that looks like this:

```php
$router->put('/listings/{id}', 'ListingController@update');
```

Your form in the edit view should be submitting to `/listings/<?= $listing->id; ?>` and have a hidden input with the name `_method` and value `PUT`.

## `update` Method

In your `App/Controllers/ListingController.php` file, add this method:

```php
  /*
   * Update a listing
   *
   * @param array $params
   * @return void
   */
  public function update($params)
  {
    inspectAndDie($params);
  }
```

You should see something like this:

```php
array(1) {
  ["id"]=>
  string(2) "19"
}
```

So we know the form is hooked up. Now we need to add the logic.

Here is the full code for the `update` method:

```php
 /*
   * Update a listing
   *
   * @param array $params
   * @return void
   */
  public function update($params)
  {
    $id = $params['id'];

    $params = [
      'id' => $id,
    ];

    $listing = $this->db->query('SELECT * FROM listings WHERE id = :id', $params)->fetch();

    if (!$listing) {
      ErrorController::notFound('Listing not found');
      return;
    }

    $allowedFields = ['title', 'description', 'salary', 'tags', 'company', 'address', 'city', 'state', 'phone', 'email', 'requirements', 'benefits'];

    $updateValues = [];

    foreach ($allowedFields as $field) {
      if (isset($_POST[$field])) {
        $updateValues[$field] = $_POST[$field];
      }
    }

    $updateValues = array_map('sanitize', $updateValues);

    // Validate required fields
    $requiredFields = ['title', 'description', 'email', 'city', 'state'];

    $errors = [];
    foreach ($requiredFields as $field) {
      if (empty($updateValues[$field]) || !Validation::string($updateValues[$field])) {
        $errors[$field] = ucfirst($field) . ' is required';
      }
    }

    if (!empty($errors)) {
      loadView('listings/edit', [
        'listing' => $listing,
        'errors' => $errors,
      ]);
      exit;
    } else {
      $updateFields = [];
      foreach (array_keys($updateValues) as $field) {
        $updateFields[] = "$field = :$field";
      }
      $updateFields = implode(', ', $updateFields);

      $updateQuery = "UPDATE listings SET $updateFields WHERE id = :id";

      // Execute the update query
      $updateValues['id'] = $id;
      $this->db->query($updateQuery, $updateValues);

      $_SESSION['success_message'] = 'Listing updated successfully';

      redirect('/listings/' . $id);
    }
  }
```

As you can see, there is a lot of the same logic as the create form. We are setting up the allowed fields, getting the values from the form, sanitizing them, validating them, and then updating the database.

In the update database logic, we are creating an array of fields and values to update. We are then imploding that array into a string and using it in the query.

If you want to see the exact query, you can use the `inspect` helper function like so:

```php
inspectAndDie($updateQuery);
```

Once we execute the query, we set a success message and redirect to the show page.
