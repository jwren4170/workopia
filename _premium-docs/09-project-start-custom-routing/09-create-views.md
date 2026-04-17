Now we will create and load the views for the routes that we created in the last lesson.

Let's start with the listings/index view. 

### Listing Index View

Create a `views/listings/index.view.php` file. The listing index will be very similar to the home page except it will have all listings. It will not have the showcase search (at least for now) and it will not have the "Show All Jobs" link at the bottom because it will show all of the jobs. The home page will just have the latest 6 or however many you want.

So we are essentially just using the home view without the search and link. You can copy the code from the `views/home.view.php` file and paste it into the `views/listings/index.view.php` file. Remove the showcase search and the "Show All Jobs" link. Also, change the title to "All Jobs". You can also get the HTML from the theme `listings.html` file if you want. At this point, it is the same HTML.

Here is the code for the view:

```php
<?= loadPartial('head') ?>
<?= loadPartial('navbar') ?>
<?= loadPartial('top-banner') ?>

<!-- Job Listings -->
<section>
  <div class="container mx-auto p-4 mt-4">
    <div class="text-center text-3xl mb-4 font-bold border border-gray-300 p-3">All Jobs</div>
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
      <!-- Job Listing 1: Software Engineer -->
      <div class="rounded-lg shadow-md bg-white">
        <div class="p-4">
          <h2 class="text-xl font-semibold">Software Engineer</h2>
          <p class="text-gray-700 text-lg mt-2">
            We are seeking a skilled software engineer to develop
            high-quality software solutions.
          </p>
          <ul class="my-4 bg-gray-100 p-4 rounded">
            <li class="mb-2"><strong>Salary:</strong> $80,000</li>
            <li class="mb-2">
              <strong>Location:</strong> New York
              <span class="text-xs bg-blue-500 text-white rounded-full px-2 py-1 ml-2">Local</span>
            </li>
            <li class="mb-2">
              <strong>Tags:</strong> <span>Development</span>,
              <span>Coding</span>
            </li>
          </ul>
          <a href="details.html" class="block w-full text-center px-5 py-2.5 shadow-sm rounded border text-base font-medium text-indigo-700 bg-indigo-100 hover:bg-indigo-200">
            Details
          </a>
        </div>
      </div>

      <!-- Job Listing 2: Marketing Specialist -->
      <div class="rounded-lg shadow-md bg-white">
        <div class="p-4">
          <h2 class="text-xl font-semibold">Marketing Specialist</h2>
          <p class="text-gray-700 text-lg mt-2">
            We are looking for a Marketing Specialist to create and manage
            marketing campaigns.
          </p>
          <ul class="my-4 bg-gray-100 p-4 rounded">
            <li class="mb-2"><strong>Salary:</strong> $70,000</li>
            <li class="mb-2">
              <strong>Location:</strong> San Francisco
              <span class="text-xs bg-blue-500 text-white rounded-full px-2 py-1 ml-2">Remote</span>
            </li>
            <li class="mb-2">
              <strong>Tags:</strong> <span>Marketing</span>,
              <span>Advertising</span>
            </li>
          </ul>
          <a href="details.html" class="block w-full text-center px-5 py-2.5 shadow-sm rounded border text-base font-medium text-indigo-700 bg-indigo-100 hover:bg-indigo-200">
            Details
          </a>
        </div>
      </div>

      <!-- Job Listing 3: Web Developer -->
      <div class="rounded-lg shadow-md bg-white">
        <div class="p-4">
          <h2 class="text-xl font-semibold">Web Developer</h2>
          <p class="text-gray-700 text-lg mt-2">
            Join our team as a Web Developer and create amazing web
            applications.
          </p>
          <ul class="my-4 bg-gray-100 p-4 rounded">
            <li class="mb-2"><strong>Salary:</strong> $75,000</li>
            <li class="mb-2">
              <strong>Location:</strong> Los Angeles
              <span class="text-xs bg-blue-500 text-white rounded-full px-2 py-1 ml-2">Local</span>
            </li>
            <li class="mb-2">
              <strong>Tags:</strong> <span>Web Development</span>,
              <span>Programming</span>
            </li>
          </ul>
          <a href="details.html" class="block w-full text-center px-5 py-2.5 shadow-sm rounded border text-base font-medium text-indigo-700 bg-indigo-100 hover:bg-indigo-200">
            Details
          </a>
        </div>
      </div>

      <!-- Job Listing 4: Data Analyst -->
      <div class="rounded-lg shadow-md bg-white">
        <div class="p-4">
          <h2 class="text-xl font-semibold">Data Analyst</h2>
          <p class="text-gray-700 text-lg mt-2">
            We are hiring a Data Analyst to analyze and interpret data for
            insights.
          </p>
          <ul class="my-4 bg-gray-100 p-4 rounded">
            <li class="mb-2"><strong>Salary:</strong> $65,000</li>
            <li class="mb-2">
              <strong>Location:</strong> Chicago
              <span class="text-xs bg-blue-500 text-white rounded-full px-2 py-1 ml-2">Remote</span>
            </li>
            <li class="mb-2">
              <strong>Tags:</strong> <span>Data Analysis</span>,
              <span>Statistics</span>
            </li>
          </ul>
          <a href="details.html" class="block w-full text-center px-5 py-2.5 shadow-sm rounded border text-base font-medium text-indigo-700 bg-indigo-100 hover:bg-indigo-200">
            Details
          </a>
        </div>
      </div>

      <!-- Job Listing 5: Graphic Designer -->
      <div class="rounded-lg shadow-md bg-white">
        <div class="p-4">
          <h2 class="text-xl font-semibold">Graphic Designer</h2>
          <p class="text-gray-700 text-lg mt-2">
            Join our creative team as a Graphic Designer and bring ideas to
            life.
          </p>
          <ul class="my-4 bg-gray-100 p-4 rounded">
            <li class="mb-2"><strong>Salary:</strong> $60,000</li>
            <li class="mb-2">
              <strong>Location:</strong> Miami
              <span class="text-xs bg-blue-500 text-white rounded-full px-2 py-1 ml-2">Local</span>
            </li>
            <li class="mb-2">
              <strong>Tags:</strong> <span>Graphic Design</span>,
              <span>Creative</span>
            </li>
          </ul>
          <a href="details.html" class="block w-full text-center px-5 py-2.5 shadow-sm rounded border text-base font-medium text-indigo-700 bg-indigo-100 hover:bg-indigo-200">
            Details
          </a>
        </div>
      </div>

      <div class="rounded-lg shadow-md bg-white">
        <div class="p-4">
          <h2 class="text-xl font-semibold">Data Scientist</h2>
          <p class="text-gray-700 text-lg mt-2">
            We're looking for a Data Scientist to analyze complex data and
            generate insights.
          </p>
          <ul class="my-4 bg-gray-100 p-4 rounded">
            <li class="mb-2"><strong>Salary:</strong> $90,000</li>
            <li class="mb-2">
              <strong>Location:</strong> Seattle
              <span class="text-xs bg-blue-500 text-white rounded-full px-2 py-1 ml-2">Remote</span>
            </li>
            <li class="mb-2">
              <strong>Tags:</strong> <span>Data Science</span>,
              <span>Machine Learning</span>
            </li>
          </ul>
          <a href="details.html" class="block w-full text-center px-5 py-2.5 shadow-sm rounded border text-base font-medium text-indigo-700 bg-indigo-100 hover:bg-indigo-200">
            Details
          </a>
        </div>
      </div>
    </div>
</section>

<?= loadPartial('bottom-banner') ?>
<?= loadPartial('footer') ?>
```

#### Load the view

In the `/controllers/listings/index.php`, remove the exho and add the following:

```php
loadView('listings/index');
```

Now in the home view, make the `Show All Jobs` link go to the `/listings` route. Change the link to the following:

```php
<a href="/listings" class="block text-xl text-center">
  <i class="fa fa-arrow-alt-circle-right"></i>
    Show All Jobs
</a>
```

You should be able to navigate to the listings with the link and go back to the home page with the logo link.

### Listing Create View

Let's add the create view. Create a `views/listings/create.view.php` file and copy the HTML from the `post-job.html` page of the theme. Not all of it, just the main form part. The navigation, footer, etc will come from the partials.

Here is the code for the create view:

```php
<?= loadPartial('head') ?>
<?= loadPartial('navbar') ?>
<?= loadPartial('top-banner') ?>

<!-- Post a Job Form Box -->
<div class="flex justify-center items-center mt-20">
  <div class="bg-white p-8 rounded-lg shadow-md w-full md:w-600 mx-6">
    <h2 class="text-4xl text-center font-bold mb-4">Post a Job</h2>
    <!-- <div class="message bg-red-100 p-3 my-3">This is an error message.</div>
        <div class="message bg-green-100 p-3 my-3">
          This is a success message.
        </div> -->
    <form>
      <h2 class="text-2xl font-bold mb-6 text-center text-gray-500">
        Job Info
      </h2>
      <div class="mb-4">
        <input type="text" name="title" placeholder="Job Title" class="w-full px-4 py-2 border rounded focus:outline-none" />
      </div>
      <div class="mb-4">
        <textarea name="description" placeholder="Job Description" class="w-full px-4 py-2 border rounded focus:outline-none"></textarea>
      </div>
      <div class="mb-4">
        <input type="text" name="salary" placeholder="Annual Salary" class="w-full px-4 py-2 border rounded focus:outline-none" />
      </div>
      <div class="mb-4">
        <input type="text" name="requirements" placeholder="Requirements" class="w-full px-4 py-2 border rounded focus:outline-none" />
      </div>
      <div class="mb-4">
        <input type="text" name="benefits" placeholder="Benefits" class="w-full px-4 py-2 border rounded focus:outline-none" />
      </div>
      <h2 class="text-2xl font-bold mb-6 text-center text-gray-500">
        Company Info & Location
      </h2>
      <div class="mb-4">
        <input type="text" name="company" placeholder="Company Name" class="w-full px-4 py-2 border rounded focus:outline-none" />
      </div>
      <div class="mb-4">
        <input type="text" name="address" placeholder="Address" class="w-full px-4 py-2 border rounded focus:outline-none" />
      </div>
      <div class="mb-4">
        <input type="text" name="city" placeholder="City" class="w-full px-4 py-2 border rounded focus:outline-none" />
      </div>
      <div class="mb-4">
        <input type="text" name="state" placeholder="State" class="w-full px-4 py-2 border rounded focus:outline-none" />
      </div>
      <div class="mb-4">
        <input type="text" name="phone" placeholder="Phone" class="w-full px-4 py-2 border rounded focus:outline-none" />
      </div>
      <div class="mb-4">
        <input type="email" name="email" placeholder="Email Address For Applications" class="w-full px-4 py-2 border rounded focus:outline-none" />
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

<?= loadPartial('bottom-banner') ?>
<?= loadPartial('footer') ?>
```

Add the following to the `/controllers/listing/create` file:

```php
loadView('listings/create');
```

Now go to the navbar partial and the bottom banner partial and change the links from `post-job.html` to `/listings/create`.

## CSS Issue

If your CSS is not working, it is probably because it is trying to load the `style.css` from `listings/css/style.css`. This is happening because there is no leading slash in the `href` attribute of the `<link>` tag in the `head` partial. Add a slash like this:

```php
<link rel="stylesheet" href="/css/style.css" />
```

Now the CSS should work and you should see the form. Obviously, it doesn't work yet, but we will get to that.

## Handle 404 Errors

We already have the router logic to load the 404 controller if the route that is requested does not exist. We have the controller loading the view. So let's create the view.

Create the view file `views/error/404.view.php`.

Copy the HTML from the theme `error.html` page. Remember, just copy the main error part, not the partials.

Here is the code:

```php
<?= loadPartial('head') ?>
<?= loadPartial('navbar') ?>

<section>
  <div class="container mx-auto p-4 mt-4">
    <div class="text-center text-3xl mb-4 font-bold border border-gray-300 p-3">404 Error</div>
    <p class="text-center text-2xl mb-4">
      This page does not exist
    </p>
  </div>
</section>

<?= loadPartial('footer') ?>
```

It is very simple. You can add more content if you want.

Now if you go to a url that is not in our routes, you should see the 404 page.
