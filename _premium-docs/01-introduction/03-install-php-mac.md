## Installing PHP On MacOS

MacOS environments are setup a little differently than Windows. We will be using [Homebrew](https://brew.sh/) to install PHP and MySQL. Homebrew is a package manager for MacOS and Linux. It makes it easy to install and update software. For now, we are just going to install PHP. We will setup our MySQL database later on.

We will also be using the development server that comes with PHP. This is a built in web server that we can use to serve our PHP files locally. This is not meant for production, but it is great for development. We will be using this for the entire course.

If you're on Windows, you can move to the next lesson and I will show you how to get setup on Windows with a tool called Laragon.

To install Homebrew, run the following command in the terminal:

```bash
/bin/bash -c "$(curl -fsSL https://raw.githubusercontent.com/Homebrew/install/HEAD/install.sh)"
```

Now you can install stuff with the following command:

```bash
brew install <package>
```

Let's install PHP with Homebrew:

```bash
brew install php
```

This will install PHP and all of it's dependencies. It may take a while. When complete, you can check the version of PHP that you have installed by running the following command:

```bash
php -v
```

You should see something like this:

```bash
PHP 8.2.7 (cli) (built: Jun 20 2023 20:51:18) (NTS)
```

You should have at least version 8.0.0 installed. If you don't, you can update it with the following command:

```bash
brew upgrade php
```

If you used Laragon on Windows, you will have a specific folder for your projects. Be sure to watch that setup video. If you used Homebrew on Mac, you can set your projects folder to whatever you want, but I will be using `~/Projects` for this course. In that, I will create a `test-project` folder with an `index.php` file. You can do this with the following commands:

```bash
mkdir ~/Projects
cd ~/Projects
mkdir test-project
touch index.php
```

Open the `test-project` folder in VS Code. You can do this by running the following command:

```bash
code ~/Projects/test-project
```

Add the following code:

```php
<?php
 echo 'Hello World!';
```

Now we can run this file in the terminal with the following command from the `test-project` folder:

```bash
php index.php
```

However, this is not the best way to run PHP. We want to run it in a web server. We can do this with the following command:

```bash
php -S localhost:8000
```

The root of your project will be where you ran the command from. Since I ran the command in the `test-project` folder, that will be the root. Now you can open your browser and go to `http://localhost:8000` and you should see the output of the `index.php` file. Now we are ready to go as far as serving our PHP files locally.
