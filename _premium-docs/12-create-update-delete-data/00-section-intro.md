# Section Intro

Now that we have a more intricate router, autoloading and namespaces, we can now focus back on CRUD operations for our listings. We'll be able to create, update and delete listings. We'll start with the create form, but before we look at inserting the data, we need to validate it. We'll be using a validation class that we'll create in the next video. Then we'll look at some other sanitization techniques. Of course, we'll also be using prepared statements to prevent SQL injection attacks.

Once we can create and insert, then we can start on updating and deleting. Another things we'll be doing in this section is adding a flash message to the session to let the user know if the listing was created, updated or deleted successfully. We'll start out by just using the `$_SESSION` superglobal, but we'll refactor it to use a Session class later on.

Let's get started with our validation class.
