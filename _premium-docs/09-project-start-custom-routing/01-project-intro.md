# Workopia Project Intro

Now it's time to start our project. I said this in the course intro, but I want to say it again. What I really want to focus on here is the underlying framework of our application. I don't mean an existing open-source framework like Laravel or Symphony. I mean the core of our application. We're not focusing on the design or the front-end all that much. It's not a React course or something like that. We're doing a lot of backend stuff. So it may not seem like a lot of functionality, because it really isn't, however to build the infrastructure or the framework for this project to sit on is a lot of work. That's why my plan is to build this project again in Laravel but since Laravel gives us that framework, we can add a lot of new features in that course.

With that said, I do want to give you a demo of the website's functionality. So let's take a look at the final product.

## The Design

The design is pretty simple. I used Tailwind CSS to style the site. Tailwind is a utility-first CSS framework. It's very easy to use and it's very powerful. I do have a Tailwind course if you're interested in learning more about it. This is a responsive layout, so it looks decent on mobile devices. Since we're using Tailwind, there will be a lot of classes in our HTML. However that means that we don't have to write any CSS. So it's a tradeoff.

## Header & Navbar

The header will have our navigation. The navigation items will change depending on if we're logged in or not. If we're logged in, we'll have a link to post a listing and a logout link. If we're not logged in, we'll have a link to login and register.

## Homepage

The homepage will have a search form where we can search for jobs by keyword and location. The search functionality will be one of the last things that we do. We also have the 6 most recent job listings on the homepage. We'll be able to click on a job listing and view the details.

## Details Page

The details page is very simple. It just tells you more about the position and the company. There's fields like description, salary, location, and contact email. There is an apply button that will just open your default email client and populate the email with the listing owners email. If you're the owner of the listing, you'll see an edit and delete button. If you're not the owner, you won't see those buttons.

## Listing Index Page

The listing index page is very similar to the homepage except that it will show all of the listings. It also doesn't have the hero with the search inputs.

## Listing Create & Edit Page

The create and edit form are very similar. The only difference is that the edit form will be populated with the current values of the listing. Of course, we will implement validation and error messages. We'll also cover some sanitization techniques.

## Login & Register Pages

We have some login and register pages. Those are pretty self explanatory. We'll be using a MySQL database to store our users and listings. We'll be using PDO to connect to the database and perform CRUD operations.

## Error Page

We also have an error page. This will be used for things like 404 errors. If you go to a route that doesn't exist, you'll see this page.

Overall, this is a really simple application, but again, the main thing I want to come accross is we're not using something like Laravel that gives us a lot of features out of the box. We're building this from scratch. We're essentially building our own framework. In fact, the core folder is called `Framework`. We're building our own router, database class, authentication system, session handling and more.

The way that build this project will be very incremental. For instance, our router will be very simple at first. In fact it will be like 5 lines of code. By the end, it will be closer to 200 lines. We'll be adding features to it as we go along. The same goes for the database class and the authentication system.

In the next video, we'll go over the HTML/CSS theme files.
