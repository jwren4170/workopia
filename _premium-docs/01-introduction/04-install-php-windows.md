## Installing PHP & MySQL on Windows

There are many ways to set these up on Windows. One of the more old school ways that I used for a very long time is to install [XAMPP](https://www.apachefriends.org/index.html). This is a package that includes PHP, MySQL, and Apache. It is a great way to get started, but it is a little heavy handed. It installs a lot of stuff that you don't need, and it can be a little confusing to setup.

We are going to use something a little more modern and lightweight. We will be using [Laragon](https://laragon.org/). Laragon is a lightweight, modern, and powerful development environment for Windows. It is a great way to get started with PHP and MySQL on Windows. You won't have to install MySQL separately later on because it is included with Laragon.

### Installing Laragon

You can download Laragon from [here](https://laragon.org/download/). There are two versions available. The full version includes Node.js, yarn, git, and more. The lite or portable version is just PHP, MySQL, and Apache. I recommend the full version, but you can use either one.

Just download the installer and go through the process and select any default options. Once it is installed, you can select "Run Laragon" or launch it from the desktop icon.

Click on the "Start All" button to start the Apache and MySQL servers. You should see a green indicator next to each one when they are running.

Now go to your browser and navigate to `localhost`. You should see the Laragon home page.

<img src="../assets/laragon1.jpg" width="400" alt="" />

The root folder for your projects is located in `C:\laragon\www`. You can create a new folder in there for your project. Let's create a folder called `php-sandbox` and a file called `test.php`.

Now open that sandbox folder in VS Code or whichever editor you prefer. Add the following code to the test.php file:

```php
<?php
echo "Hello World!";
```

Now go back to your browser and navigate to `localhost/php-sandbox/test.php`. You should see the text "Hello World!".

### Hosts File & Local Domains

The hosts file is a file on your computer that maps hostnames to IP addresses. This is how your computer knows where to go when you type in a URL. For example, when you type in `localhost` in your browser, your computer knows to go to `127.0.0.1` which is the IP address for your computer.

On Windows, your hosts file is located at `C:\Windows\System32\drivers\etc\hosts`. You can manually add entries to this file, but Laragon actually creates a custom entry for you. So you have a custom local domain that is whatever the name of the folder in `C:\laragon\www` is and then `.test`. So in our case, we have a folder called `php-sandbox` so we can access it at `php-sandbox.test`. How cool is that? Just make sure that you stop and start Laragon for the changes to take effect.

