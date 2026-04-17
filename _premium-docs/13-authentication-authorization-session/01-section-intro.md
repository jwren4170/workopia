# Section Intro

Alright, so we have a complete CRUD app with a nice base infrastructure/framework. Now we are going to start adding authentication and authorization. This is a vanilla PHP course, so we will be doing everything manually with sessions, but just know that there are many packages and libraries that can help with this.

We already have a users table. We need to create a users controller as well as a view for the login and register pages. Then we can add the logic to register a user and log them in. We will also add a logout method. We'll do this with the help of a Session class that we'll create.

We are going to be adding middleware to our routes as well. Middleware is code that runs before a controller method. We will be using it to check if a user is logged in or not and directing them to the correct place. Then we can protect certain routes.

Then we'll need to make it so only the listing owner can edit and delete their listings. We'll also add a flash message to the session to let the user know if they were successful or not.

Let's get started.
