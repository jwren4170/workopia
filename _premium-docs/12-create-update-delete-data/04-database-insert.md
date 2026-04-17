# Database Insert

Now we are ready to insert our data. This is going to seem harder than it really is only because we have a lot of data/fields. If we were doing a todo app with a title and body, it would be much simpler. I wanted to do something more realistic though. So we need to piece together the query and the data.

Ultimately, our query should look like this:

```php
$this->db->query('INSERT INTO listings (title, description, salary, tags, company, address, city, state, phone, email, requirements, benefits, user_id) VALUES (:title, :description, :salary, :tags, :company, :address, :city, :state, :phone, :email, :requirements, :benefits, :user_id)', $newListingData);
```

BUT

If we do this, it will insert everything even empty fields in the form. We need to make sure that we only insert the fields that have data. So we need to build the query dynamically. We can do this by looping through the `$newListingData` array and adding the keys to a new array called `$fields`. Then we can use the `implode` function to create a comma separated string of the fields. We can then do the same thing for the values. Here is the code:

```php
$fields = [];

foreach ($newListingData as $field => $value) {
  $fields[] = $field;
}

$fields = implode(', ', $fields);

$values = [];

foreach ($newListingData as $field => $value) {
  // Convert empty strings to null
  if ($value === '') {
    $newListingData[$field] = null;
  }
  $values[] = ':' . $field;
}

$values = implode(', ', $values);

$query = "INSERT INTO listings ({$fields}) VALUES ({$values})";

$this->db->query($query, $newListingData);
```

You can run `inspectAndDie($query);` before calling the `query` method to see the query that is being built.

The last thing that we want to do is redirect to the listings page.

## Redirect Helper Function

In PHP, we can redirect like this:

```php
header('Location: /listings');
exit;
```

I want to make it a bit easier and create a helper function in the `helpers.php` file. Add this function:

```php
/**
 * Redirect to a given URL
 *
 * @param string $url
 * @return void
 */
function redirect($url)
{
  header("Location: {$url}");
  exit;
}
```

Now in the controller, we can just do this:

```php
redirect('/listings');
```

Now you should be able to submit the form and have the data submitted to the database. You can check it in MySQL Workbench and you should see it added on the home and listings page.
