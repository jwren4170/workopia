# Implement Validation

Now we will make sure that required fields can not be empty.

## Required Fields

Now we need to make sure that the required fields are present. We can do this by creating a `requiredFields` array and looping through and checking if the key is present in the `$newListingData` array. If it is not, we can add an error to the `$errors` array.

```php
// Validate required fields
$requiredFields = ['title', 'description', 'email', 'city', 'state'];

$errors = [];
foreach ($requiredFields as $field) {
  if (empty($newListingData[$field]) || !Validation::string($newListingData[$field])) {
    $errors[$field] = ucfirst($field) . ' is required';
  }
}

inspectAndDie($errors);
```

Now fill out the form and leave out the `title` field. You should see an error for the `title` field.

Next we will check to see if the `$errors` array is not empty. If it is not, we want to show the form again and pass the errors into the view. Here is the full code for `show` up to this point:

```php
public function store()
  {
    $allowedFields = ['title', 'description', 'salary', 'tags', 'company', 'address', 'city', 'state', 'phone', 'email', 'requirements', 'benefits'];

    // Filter the POST data to include only allowed fields
    $newListingData = array_intersect_key($_POST, array_flip($allowedFields));

    // Add user_id to the data
    $newListingData['user_id'] = 1; // Hardcoded user id for now

    // Sanitize the data
    $newListingData = array_map('sanitize', $newListingData);

    // Validate required fields
    $requiredFields = ['title', 'description', 'email', 'city', 'state'];

    $errors = [];
    foreach ($requiredFields as $field) {
      if (empty($newListingData[$field]) || !Validation::string($newListingData[$field])) {
        $errors[$field] = ucfirst($field) . ' is required';
      }
    }

    if (!empty($errors)) {
      loadView('listings/create', [
        'errors' => $errors,
      ]);
      exit;
    } else {
      echo 'Success';
      // All required fields are present and validated
      // Insert data into the database, including non-required fields
      // ...
    }
  }
```

If you fill in all required fields, you should see `Success`.

## Display Errors

Now we need to display the errors in the view. Open `App/views/listings/create.view.php` and replace the commented out HTML under the `<h2>` with this:

```php
<?php if (isset($errors)) : ?>
  <?php foreach ($errors as $error) : ?>
    <div class="message bg-red-100 p-3 my-3"><?php echo $error; ?></div>
  <?php endforeach; ?>
<?php endif; ?>
```

Now when there are errors, they will be displayed.

## Show the submitted data

Right now, when you get errors, the entire form will clear. We need to show the data that was submitted. We can do this by adding a `value` attribute to each input and setting it to the submitted value. I don't want to use the `$_POST` superglobal directly, so let's pass the `$newListingData` array to the view as `listing`.

In the `store` method, replace the `loadView` function with this:

```php
loadView('listings/create', [
  'errors' => $errors,
  'listing' => $newListingData,
]);
```

Now, in the view, we can use the `$listing` array to set the `value` attribute of each input. Here is the full code for the create view:

```php
<?php loadPartial('head'); ?>
<?php loadPartial('navbar'); ?>
<?php loadPartial('top-banner'); ?>

<!-- Post a Job Form Box -->
<div class="flex justify-center items-center mt-20">
  <div class="bg-white p-8 rounded-lg shadow-md w-full md:w-600 mx-6">
    <h2 class="text-4xl text-center font-bold mb-4">Post a Job</h2>
    <?php if (isset($errors)) : ?>
      <?php foreach ($errors as $error) : ?>
        <div class="message bg-red-100 p-3 my-3"><?php echo $error; ?></div>
      <?php endforeach; ?>
    <?php endif; ?>
    <form method="POST" action="/listings">
      <h2 class="text-2xl font-bold mb-6 text-center text-gray-500">
        Job Info
      </h2>
      <div class="mb-4">
        <input type="text" name="title" placeholder="Job Title" class="w-full px-4 py-2 border rounded focus:outline-none" value="<?= $listing['title'] ?? '' ?>" />
      </div>
      <div class="mb-4">
        <textarea name="description" placeholder="Job Description" class="w-full px-4 py-2 border rounded focus:outline-none"><?= $listing['description'] ?? '' ?></textarea>
      </div>
      <div class="mb-4">
        <input type="text" name="salary" placeholder="Annual Salary" class="w-full px-4 py-2 border rounded focus:outline-none" value="<?= $listing['salary'] ?? '' ?>" />
      </div>
      <div class="mb-4">
        <input type="text" name="requirements" placeholder="Requirements" class="w-full px-4 py-2 border rounded focus:outline-none" value="<?= $listing['requirements'] ?? '' ?>" />
      </div>
      <div class="mb-4">
        <input type="text" name="benefits" placeholder="Benefits" class="w-full px-4 py-2 border rounded focus:outline-none" value="<?= $listing['benefits'] ?? '' ?>" />
      </div>
      <h2 class="text-2xl font-bold mb-6 text-center text-gray-500">
        Company Info & Location
      </h2>
      <div class="mb-4">
        <input type="text" name="company" placeholder="Company Name" class="w-full px-4 py-2 border rounded focus:outline-none" value="<?= $listing['company'] ?? '' ?>" />
      </div>
      <div class="mb-4">
        <input type="text" name="address" placeholder="Address" class="w-full px-4 py-2 border rounded focus:outline-none" value="<?= $listing['address'] ?? '' ?>" />
      </div>
      <div class="mb-4">
        <input type="text" name="city" placeholder="City" class="w-full px-4 py-2 border rounded focus:outline-none" value="<?= $listing['city'] ?? '' ?>" />
      </div>
      <div class="mb-4">
        <input type="text" name="state" placeholder="State" class="w-full px-4 py-2 border rounded focus:outline-none" value="<?= $listing['state'] ?? '' ?>" />
      </div>
      <div class="mb-4">
        <input type="text" name="phone" placeholder="Phone" class="w-full px-4 py-2 border rounded focus:outline-none" value="<?= $listing['phone'] ?? '' ?>" />
      </div>
      <div class="mb-4">
        <input type="email" name="email" placeholder="Email Address For Applications" class="w-full px-4 py-2 border rounded focus:outline-none" value="<?= $listing['email'] ?? '' ?>" />
      </div>
      <button class="w-full bg-green-500 hover:bg-green-600 text-white px-4 py-2 my-3 rounded focus:outline-none">
        Post Job
      </button>
      <a href="/" class="block text-center w-full bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded focus:outline-none">
        Cancel
      </a>
    </form>
  </div>
</div>

<?php loadPartial('bottom-banner'); ?>
<?php loadPartial('footer'); ?>
```

Now it will keep the submitted data when there are errors.

## Errors Partial

This is optional, but you can create a file called `App/views/partials/errors.php` and move the following to that file:

```php
<?php if (isset($errors)) : ?>
      <?php foreach ($errors as $error) : ?>
        <div class="message bg-red-100 p-3 my-3"><?php echo $error; ?></div>
      <?php endforeach; ?>
    <?php endif; ?>
```

You can then load the partial and pass in the data:

```php
<?= loadPartial('errors', [
  'errors' => $errors
]) ?>
```

Make sure that in the `helpers.php`, the loadPartial() function can take in data:

```php
function loadPartial($name, $data = [])
{
  $partialPath = basePath("App/views/partials/{$name}.php");

  // Make sure path exists
  if (file_exists($partialPath)) {
    extract($data);
    require $partialPath;
  } else {
    echo "Partial '{$name}' not found.";
  }
}
```

In the next lesson, we will actually submit the data.
