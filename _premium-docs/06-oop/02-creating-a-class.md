# Creating a Class

In this lesson, we will create a class, which remember, is basically a blueprint for creating objects. We will then create an object from that class and access its properties and methods. The process of creating an object from a class is called **instantiation**.

Let's create a class called `User` either in the sandbox files or in your own file:

```php
class User
{
    // Class body
}
```

We use the `class` keyword to create a class. The class name should be in PascalCase, which means the first letter of each word should be capitalized. The class body is enclosed in curly braces.

## Adding Properties

A property is basically a variable or an attribute that belongs to a class. We can add properties to our class like this:

```php
class User
{
    public $name;
    public $email;
}
```

Here, we have added two properties to our `User` class: `$name` and `$email`. We use the `public` keyword to specify the visibility of the property. We will learn more about visibility in the next lesson. For now, just know that `public` means the property can be accessed from outside the class.

## Default Values

We can also set default values for our properties:

```php
class User
{
    public $name = 'John Doe';
    public $email = 'john@gmail.com';
}
```

## Adding Methods

A method is basically a function that belongs to a class. We can add methods to our class like this:

```php
class User
{
    public $name;
    public $email;

    public function login()
    {
        echo 'The user logged in.';
    }
}
```

Here, we have added a method called `login` to our `User` class.

## Instantiating an Object

Now that we have a very basic `User` class, let's create an object from it:

```php
$user1 = new User();
```

We use the `new` keyword to create an object from a class. The variable `$user1` now holds an object of the `User` class. We can access the properties and methods of the object using the arrow operator (`->`):

```php
$user1->name = 'John Doe';
$user1->email = 'john@gmail.com';

echo $user1->name; // John Doe
echo $user1->email; // john@gmail.com
```

We can also call the `login` method on the object:

```php
$user1->login(); // The user logged in.
```

## The constructor method

The constructor method is a special method that is called automatically when an object is instantiated. We can use it to set the initial state of the object. In the code that we have written, we first instantiated a user object and then set its name and email properties. We can simplify this process by passing the name and email as arguments to the constructor method:

```php
class User
{
    public $name;
    public $email;

    public function __construct($name, $email)
    {
        $this->name = $name;
        $this->email = $email;
    }

    public function login()
    {
        echo 'The user logged in.';
    }
}
```

## `this` keyword

In the constructor method, we used the `$this` keyword to set the `name` and `email` properties. The `$this` keyword refers to the current object. So when we say `$this->name`, we are referring to the `name` property of the current object. We will learn more about `$this` as we go along.

Now, instead of assigning the name and email properties after instantiating the object, we can pass them as arguments to the constructor method:

```php
$user1 = new User('John Doe', 'john@gmail.com');
```

We can create as many users as we want from this class. Let's create another instance:

```php
$user2 = new User('Jane', 'jane@gmail.com');
```

We can now get any property or call any methods on these objects:

```php
echo $user1->name; // John Doe
echo $user2->name; // Jane

$user1->login(); // The user logged in.
$user2->login(); // The user logged in.
```

## Using `this` in methods

We can use the `$this` keyword in methods as well. Let's change the `login` method to use the `$this` keyword:

```php
public function login() {
    echo $this->name . ' logged in.';
}
```

Now if we call the `login` method on the `$user1` object, it will echo `John Doe logged in.` If we call it on the `$user2` object, it will echo `Jane logged in.` This is because it pertains to the current object.

Now that we know how to create classes with properties, methods and a constructor, let's look at visibility in the next lesson.
