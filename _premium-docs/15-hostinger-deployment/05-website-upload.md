# File Upload

Now it's time to get our website files on the Hostinger server. There are a few ways to do this. We could use Git, however, since we have a lot of backend code, we need to make some changes to file paths, etc. So instead of using Git, we will use the super fast file manager. You can simply drag and drop your files and edit them on the fly. 

Log into your hPanel and click on `Files->File Manager`. You should see a folder called `public_html`. This is the folder that the internet sees. So we only want the files from our `public` folder in there. So drag over the index.php and everything else in the `public` folder on your local machine to the `public_html` on the server. Make sure that the `.htaccess` file is included.

Next, we need to upload the rest of the files. We don't want to put these in the root. Create a folder called `src` on the same level as the `public_html`. Drag the rest of your files into that folder.

If you go to your domain, you will get an error. There are a few things we need to change.

### Show errors
I want to see the errors PHP gives us. They don't show by default because of how the server is configured. We can fix this by adding 2 lines of code to the top of the `public_html/index.php` file:

```php
ini_set('display_errors', 1);
error_reporting(E_ALL);
```

### File paths

In `public_html/index.php` on the server use the following paths:

```php
require __DIR__ . '/../src/vendor/autoload.php';

require '../src/helpers.php';
```

We are just adding the `src` folder.

### Database Credentials

Now you should see an error that has to do with the database. We are still using the local credentials. Open the `config/db.php` and add the new database name and user as well as the password that you used when creating it.

Now go to your URL/domain and you should see the website!



