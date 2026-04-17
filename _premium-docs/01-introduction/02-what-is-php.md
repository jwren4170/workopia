# What Is PHP?

Alright, so before we write any code, I want to talk a little bit about what PHP is, what it's capable of as well as it's pros and cons.

PHP stands for "PHP: Hypertext Preprocessor" and is an open-source server-side scripting language that is used to develop web applications. It's been around since 1994 and is one of the most popular programming languages on the web. It's used by something like 70% of all websites that use a server-side language. This includes content management systems like Wordpress and frameworks like Laravel. In fact, this course is a precursor to my Laravel course, which will be released in the coming months.

PHP can be used to build anything from a simple contact form to a full-blown social network. It's also very easy to learn and has a ton of resources available. Getting setup is also really easy compared to many other server-side languages.

## How PHP works

Let's go over how PHP actually works. When you use your client to go to a website url that uses a `.php` extension, the server will pass the file to the PHP interpreter, which then reads the file and executes any PHP code that it finds. It also has access to any databases you may want to use as well as the file system. The output of the PHP code, which is in HTML format is then sent back to the the client, which then sends it to the user's browser. HTML can also be put directly in a PHP file, which makes it very convenient.

## Server Side vs Client Side

PHP is a server-side language. What does that mean? Well, it means that the code is executed on the server and the output is sent to the user's browser. This is different from a client-side language like JavaScript, where the code is executed in the user's browser. JavaScript can run on the server with Node.js, but that's a different topic.

## Why Use A Server-Side Language?

So why use a server-side language? Well, there are many reasons, but here are a few big ones. 

- Security: It's more secure. Since the code is executed on the server, the user can't see it. This is important for things like database credentials. 
- Efficiency: Since the code is executed on the server, the user's browser doesn't have to do any work. This is important for things like mobile devices. 
- Database Access: you can access a database. This is essential for any kind of complex application like an eCommerce website or social network. 
- File System Access: You also have access to the file system, so you can read from and write to files.
- Authentication: Server-side code is needed for any kind of custom authentication
- Sessions: Allow you to maintain user state and store user-specific data across multiple requests. This is essential for building features like user logins, shopping carts, and personalized user experiences.

## Why Use PHP?

There are many server-side languages out there and I'm not one to say that you should use one over the other. I love PHP but I also love Node.js and Python. I think they all have their place. 

PHP is very easy to learn compared to other languages. Not just the syntax, but the setup and environments.

It has a ton of flexibility. In fact, when using vanilla PHP, meaning no frameworks like Laravel or Symphony is so flexible that it can get you in trouble if you don't write clean code. You can be open to security vulnerabilities and other issues. We're going to go over that stuff in detail in this course.

You can also create things very quickly with PHP, which is why I think it's the most popular language among freelancers. As a former freelancer, I can tell you that getting projects out to cliets in a timely manner is extremely important.

PHP is completely open-source and has a great community. You can always find the answers when you're having issues. `php.net` docs are a great resource as well.

PHP integrates very well with web servers like Apache and NGINX.


## PHP & HTML

One very unique thing about PHP is that it can be mixed with HTML. This is because PHP was designed to be a templating language. So you can have a PHP file that contains HTML and PHP code. The PHP code is executed on the server and the output is sent to the user's browser. This is very different than other languages where you need to use some sort of templating engine or a front-end framework like React or Vue. PHP is a templating engine in itself.

## PHP & Databases

Another thing that makes PHP great is that it has a ton of database support. It has drivers for MySQL, PostgreSQL, MongoDB, and many more. This makes it very easy to connect to a database and perform CRUD operations. We'll be using MySQL in this course along with PDO, which is a PHP extension that allows us to connect to a database and perform operations. PDO is a very powerful extension and it's used by many frameworks like Laravel and Symphony.

We'll also be using tools like the MySQL shell and MySQL Workbench to create our database and tables.

## PHP Controversy

PHP has been around for a long time and it's gone through many changes. It definitely has its pros and cons. One of the biggest cons is that it's very easy to write bad code. This is because it's so flexible. You can write code that's very hard to read and maintain.

With that said, the solution for this is to learn how to write clean code. This is something that we'll be going over in this course. We'll be using a lot of object-oriented programming. We'll also be using a lot of modern PHP features like namespaces and autoloading.

Another solution is to use a framework, specifically Laravel. Laravel is a very powerful framework. It's very opinionated and it forces you to write clean code. It also has a ton of features out of the box. Laravel is such a great framework that even people that don't particularly like PHP love Laravel. It's extremely clean and scure. It's also very easy to learn. Like I said, I'll be releasing a Laravel course in the coming months, so stay tuned for that.

## Who Uses PHP?

So who uses PHP? What type of developers and which jobs? It's used by some giant companies like Facebook and Wikipedia, however it's not extremely popular among FANG-type companies. Where it really shines is in small to medium-sized businesses. It's also very very popular among freelancers. If your goal is to become a freelancer, PHP is the language I would suggest because you can build things fast and that's what your clients need. They don't care about the language, they care about the end result. PHP is also very popular among content management systems like Wordpress and Drupal. Wordpress accounts for a huge chunk of websites. When I was a freelancer, I would build Wordpress sites and knowing PHP realy well helped me a lot. It allows you to get in and customize themes and plugins and even create your own. Web agencies also use PHP a lot. So if you're looking to get a job at a web agency, PHP is a great language to learn. I'm not saying that you shouldn't learn PHP if you want to work at a huge company, but it's not as popular as other languages like Python and JavaScript. It's one of the most popular for just about everything else.
