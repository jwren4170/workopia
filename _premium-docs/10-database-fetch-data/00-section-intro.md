# Section Intro

Alright guys, so we have a working router that can handle multiple types of requests. We're still mapping routes to a single file. We'll change it to work with a controller class later on. Right now, I want to focus on the database. We're going to be using MySQL and PDO to connect to the database. We'll start our database class which will connect and we'll also have a `query` method. Just like with everything else, we'll start simple and add features as we go along.

We're also going to make it so that we can pass the data that we get from our database into the view using the `loadView()` function. This will work similar to how Laravel and other frameworks do this. Once the view has the data, we can then display it within our layout.

Let's get started.
