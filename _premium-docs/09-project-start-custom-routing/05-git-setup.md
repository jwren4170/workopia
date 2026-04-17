# Git Setup

This is technically optional, but I would highly reccomend that you use Git version control. Git allows you to save and version your work. Git is something every developer needs to at least know the basics of. We will create a Git repository now and make a commit. You can continue to make commits and save your code when you see fit.

## `.gitignore` File

Before we initialize a repo, we should create a `.gitignore` file, which let's us specify which files and folders should NOT be included in our repo. Create the file in your root directory and add the following:

```
/vendor
/node_modules
/config/db.php
.env
.vscode
.DS_Store
```

We will be using a package manager called **Composer** to use an autoloader. Composer packages are put in the `vendor` folder, so we don't want that included. 

We won't be using NPM (Node Package Manager), but just in case you do install any NPM packages, we also want to add `node_modules`.

`config/db.php` will have our database credentials in it. You certainly do not want to include that.

I added `.env` just in case you use it for environment variables.

`vscode` is your custom settings for VS Code.

`.DS_Store` is a file system file on MacOS.

## Initialize a Repo

Now let's open the terminal in the project root and initialize a repo:

```bash
git init
```

Let's add everything to the staging area:

```bash
git add .
```

Let's commit to the local repo:

```bash
git commit -m 'Initial commit and started home view'
```

## Setup Github Repo

We want to push this to a remote repo. We will use Github. If you do not have an account, create one at github.com.

Click the `+` icon on the top right of the main menu to create a new repo.

Give it a name like `workopia`.

You should see a bunch of commands to push to that repo.

Copy the first `git remote add` command on the bottom to add the repo. Paste it in your terminal and run. 

Copy the next command to use the `main` branch. Paste it in your terminal.

Copy and paste the last `git push -u origin main` command.

Refresh the Github repo and you should see your files.
