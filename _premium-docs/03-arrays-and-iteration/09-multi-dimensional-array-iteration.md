# Mutli-Dimensional Array Iteration and HTML Output

Let's use the knowledge we have now to create a page that lists job openings and their descriptions. We will create an array with the data and display them nicely.

## Generating Data With Chat GPT

You can copy the data that I used below or create it yourself, but I am going to use `ChatGPT`, which is an incredible tool that uses AI to generate text and can do pretty much anything that you tell it to. Generating sample data is a great use case for it. To follow along, go to https://chat.openai.com and enter the following:

```
Give me a PHP array of job listings with the following data: id, title, description, salary, location, and tags. There should be 5 items in the array.
```

You should get something like this:

```php
$listings = [
    [
        'id' => 1,
        'title' => 'Software Engineer',
        'description' => 'We are seeking a skilled software engineer to develop high-quality software solutions.',
        'salary' => 80000,
        'location' => 'San Francisco',
        'tags' => ['Software Development', 'Java', 'Python']
    ],
    [
        'id' => 2,
        'title' => 'Marketing Specialist',
        'description' => 'We are looking for a marketing specialist to develop and implement effective marketing strategies.',
        'salary' => 60000,
        'location' => 'New York',
        'tags' => ['Digital Marketing', 'Social Media', 'SEO']
    ],
    [
        'id' => 3,
        'title' => 'Accountant',
        'description' => 'We are hiring an experienced accountant to handle financial transactions and ensure compliance.',
        'salary' => 55000,
        'location' => 'Chicago',
        'tags' => ['Accounting', 'Bookkeeping', 'Financial Reporting']
    ],
    [
        'id' => 4,
        'title' => 'UX Designer',
        'description' => 'We are seeking a talented UX designer to create intuitive and visually appealing user interfaces.',
        'salary' => 70000,
        'location' => 'Seattle',
        'tags' => ['User Experience', 'Wireframing', 'Prototyping']
    ],
    [
        'id' => 5,
        'title' => 'Customer Service Representative',
        'description' => 'We are looking for a friendly customer service representative to assist customers and resolve issues.',
        'salary' => 40000,
        'location' => 'New York',
        'tags' => ['Customer Support', 'Communication', 'Problem Solving']
    ],
];
```

Open the file for this lesson called `index_start.php`. You can rename it to `index.php` or whatever you want. Paste the multi-dimensional array above into the top PHP section under the `$title` variable. We will use this array to create our job listings.

Under the `<!--Output-->` comment, add the following:

```php
 <?php foreach ($listings as $job): ?>
    <div class="md my-4">
      <div class="bg-white rounded-lg shadow-md">
        <div class="p-4">
          <h2 class="text-xl font-semibold"><?= $job['title'] ?></h2>
          <p class="text-gray-700 text-lg mt-2"><?= $job['description'] ?></p>
          <ul class="mt-4">
            <li class="mb-2">
              <strong>Salary:</strong> <?= $job['salary'] ?>
            </li>
            <li class="mb-2">
              <strong>Location:</strong> <?= $job['location'] ?>
            </li>
            <li class="mb-2">
              <strong>Tags:</strong> <?= implode(', ', $job['tags']) ?>
            </li>
          </ul>
        </div>
      </div>
    </div>
  <?php endforeach; ?>
```

It may look like a lot, but we are not doing anything different than we did with the users array with the name and email. There are just more fields and more HTML code and Tailwind classes. We are using a `foreach` loop to iterate over the `$listings` array and output the data for each job listing.

Notice for the tags, we are using `implode()` to convert the array into a string and separate each tag with a comma.

It should look like this:

<img src="../assets/images/job-listings.png" width="700" />
