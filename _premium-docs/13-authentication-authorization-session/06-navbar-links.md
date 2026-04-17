# Navbar Links

Right now, there is no way in our app to show that we are logged in and there is a session/cookie. Let's open the `App/views/partials/navbar.php` file and replace the current code with the following:

```php
<?php
use Framework\Session;
?>

<!-- Nav -->
<header class="bg-blue-900 text-white p-4">
  <div class="container mx-auto flex justify-between items-center">
    <h1 class="text-3xl font-semibold">
      <a href="/">Workopia</a>
    </h1>
    <nav class="space-x-4">
      <?php if (Session::has('user')) : ?>
        <div class="flex justify-between items-center gap-4">

          <div>
            Welcome <?= Session::get('user')['name'] ?>
          </div>
          <form>
            <button type="submit" class="text-white inline hover:underline">
              Logout
            </button>
          </form>
          <a href="/listings/create" class="bg-yellow-500 hover:bg-yellow-600 text-black px-4 py-2 rounded hover:shadow-md transition duration-300"><i class="fa fa-edit"></i> Post a Job</a>
        </div>
      <?php else : ?>
        <a href="/auth/login" class="text-white hover:underline">Login</a>
        <a href="/auth/register" class="text-white hover:underline">Register</a>
      <?php endif; ?>
    </nav>
  </div>
</header>
```

We use the `Framework\Session` namespace. 

We then use `Session::has('user')` to see if there is a user session. We show the logout and create button along with a welcome message if the user is logged in. We show the login and register links if not.

Let's add the logout functionality in the next lesson.
