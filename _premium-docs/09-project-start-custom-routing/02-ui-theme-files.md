# UI Theme Files

I have created the HTML and CSS for this project and included the files in the download for this lesson. Download the theme folder to your machine.

Once you have the files, open the folder in a separate editor than the one you'll be creating your PHP project in. This is so you have easy access to the HTML and CSS. We will be copying and pasting some of it into our views.

## The HTML

Let's take a look at the HTML files included:

- **index.html:** This is the homepage. It includes a hero area with a search box. The search will be the last thing that we do. It has some banners and it has the 6 most recent job listings with a link to the listings page.

* All pages will have the header with the navbar and links

- `listings.html`: This is very similar to the homepage except there is no hero and it will show all job listings.
- `details.html`: The single listing page with all of the data. There will be an edit and delete button visible to the listing owner.
- `post-job.html`: Form to create a new listing
- `login.html`: Login form to login
- `register.html`: Register form to sign up and create an account
- `error.html`: Error page for 404, 403, etc

## The CSS

I used the Tailwind CLI to create this theme. This is not a Tailwind course, so I won't go into detail on that. I do have a 12 hour Tailwind course if you're interested.

The `css/style.css` is the main stylesheet that is included in the html files. 

There is an `input.css` file that is the CSS that gets compiles Tailwind. If you do want to add any custom CSS, I would suggest adding it there and recompiling using the Tailwind CLI.

## `listing-data.php`

This is simply an array with some sample data for job listings. It is not used in any way. It is there for you to get some data to use in the project.

## Customization

Like I said, the theme uses the Tailwind CLI, so if you want to modify it, first install the dependencies usiing NPM:

```bash
npm install
```

Then run the CLI:

```bash
npm run watch
```

This will watch for any changes and transpile the `input.css` to the `style.css`.