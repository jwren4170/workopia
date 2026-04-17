# Section Intro

This section is going to get a little hairy. We're basically going to change the entire infrastructure of the project. We're going to be structuring it more like a real-life application. Similar to how Laravel is structured but of course much much simpler.

The main tasks that I want to tackle in this section are:

- **Folder Structure:** Basically I want anything that is at the core of the project in a folder called `Framework`. This is the framework of our application. Things like the router, the database class, validation, etc will go in this folder. Then we'll have an `App` folder for our application. This will contain our controllers, views, models, etc.
- **Namespaces:** We're going to be using namespaces to make our code more organized and to avoid conflicts. This will also allow us to autoload our classes so we don't have to require them in every file.
- **Controller Classes:** We're going to be creating controller classes instead of just using single files. This will make our code more organized.
- **Router Refactor:** Since we'll be using controller classes, we'll need to refactor the router to handle this.

I won't lie, this is probably the most difficult part of the course. But, we'll take it slow and I'll try and explain everything as best as I can. Once we get this done, adding routes, working with the database, etc will be much easier.
