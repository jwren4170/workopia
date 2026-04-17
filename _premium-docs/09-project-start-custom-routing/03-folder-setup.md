# Folder Setup

Now we want to create our project folder. If you are on Windows and using Laragon, create a folder in `C:\laragon\www` called `workopia`. If you are using XAMPP, create it in your `htdocs` folder.

If you are on a Mac and you setup everything via Homebrew, create a folder in your home directory or anywhere that you would like called `Projects` or `Sites` and put your `workopia` folder there.

Create an index.php file and add the following:

```php
<?php

echo 'Hello World';
```

In Windows with Laragon, go to `http://workopia.test` and you should see `Hello World`.

In Windows with XAMPP, go to `http://localhost/workopia` and you should see `Hello World`.

In MacOS, run:

```bash
cd ~/Sites/workopia
php -S localhost:8000
```

Then go to `http://localhost:8000` and you should see `Hello World`.

Now we can start bringing in some of the HTML for our home view.
