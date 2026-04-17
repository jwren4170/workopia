# Text Editor Setup

As far as text editors and IDEs go, you have a lot of options. I recommend using [Visual Studio Code](https://code.visualstudio.com/). It is free, open source, and has a large community of developers that contribute to it. It is also available on Mac, Windows and Linux, so you can use it on any operating system.

Some other great options are [PHP Storm]](https://www.jetbrains.com/phpstorm/) and [Sublime Text](https://www.sublimetext.com/). These are not free, but Sublime Text does have a free trial.

So get one of those installed on your system.

## VS Code Extensions

If you are using VS Code as I am, there are some handy extensions that I would suggest right off the bat. You can find these by clicking on the extensions icon on the left side of the editor.

- [PHP Intelephense](https://marketplace.visualstudio.com/items?itemName=bmewburn.vscode-intelephense-client) - This is a PHP code intelligence extension. It will help you with auto-completion, parameter hints, and more.
- [PHP Docblocker](https://marketplace.visualstudio.com/items?itemName=neilbrayfield.php-docblocker) - This will allow you to quickly add docblocks, which are multiple lined comments that describe what a function or a class does. I want to stick to writing clean code in this course and this will help us do that by documenting our code.

## Formatting

As far as formatting goes, you can select "Format on Save" in your settings and it will automatically format your code when you save, which is really helpful. In order for it to work with PHP, I believe that you have to add the following to your main settings file so that it works with Intelephense.

Open your VSCode user settings JSON file by opening the command palette (CMD + SHIFT + P on Mac, CTRL + SHIFT + P on Windows) and typing "Open Settings (JSON)".

```json
"[php]": {
    "editor.formatOnSave": true,
    "editor.defaultFormatter": "bmewburn.vscode-intelephense-client"
},
```

#### Prettier

 [Prettier](https://marketplace.visualstudio.com/items?itemName=esbenp.prettier-vscode) is a great code formatter. Unfortunately it does not work with PHP out of the box, however, there is a plugin that you can install with NPM if you want.

In order to install the plugin, you need to have [Node.js](https://nodejs.org/en/) installed. You can download and install it from the website. Once you have it installed, you can open a terminal and run the following command from whichever directory you are working in:

```bash
npm init -y
npm i prettier @prettier/plugin-php
```


This is completely optional. I won't be using the Prettier plugin.
