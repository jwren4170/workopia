# Inheritance

In the last lesson, we looked at visibility and the access modifiers. I showed you an example of `public` and `private`, but I couldn't fully explain `protected` because we hadn't learned about inheritance yet.

Inheritance is simply the ability to create a new class from an existing class. The new class is called a child class or a subclass. The existing class is called a parent class or a superclass. The child class inherits all of the properties and methods of the parent class. Let's create a new class called `Admin` that inherits from the `User` class:

```php
class Admin extends User
{
    public $level;

    public function __construct($name, $email, $level)
    {
        $this->level = $level;
        parent::__construct($name, $email); // Calls the parent constructor
    }
}
```

We use the `extends` keyword to inherit a class. We added a constructor that takes in the same 2 properties that the `User` class takes in, plus a new property called `level`. We set the value of the `level` property to the value of the `$level` argument that is passed to the constructor. We also call the parent constructor using the `parent` keyword. This is necessary because the parent constructor sets the `name` and `email` properties.

Let's initialize a new `Admin`:

```php
$admin1 = new Admin('Tom Smith','tom@gmail.com', 5);
```

We can access the properties and methods of the `User` class using the arrow operator:

```php
echo $admin1->name; // Tom Smith
echo $admin1->email; // tom@gmail
$admin1->login(); // Tom Smith logged in.
```

Now watch this. This is where the `protected` access modifier comes in. Let's change the access modifier of the `status` property in the `User` class to `protected`:

```php
protected $status;
```

Let's add a new method in the `Admin` class called `showStatus`:

```php
public function showStatus() {
  echo $this->status;
}
```

Now you should see the status. However, if you try to access the `status` property directly, you will get an error:

```php
echo $admin1->status; // Fatal error: Uncaught Error: Cannot access protected property Admin::$status
```

This is because you can only access `protected` properties and methods from within the class and any class that inherits from it.

If you change the modifier to `private`, you won't even be able to access it from within the child class. It is only accessible from within the parent class.

## Overriding Methods

You can override methods in the child class. Let's override the `login` method in the `Admin` class:

```php
public function login()
{
    echo 'Admin ' . $this->name . ' logged in.';
}
```

Now if you call the `login` method on the `Admin` instance, you will see the new message:

```php
$admin1->login(); // Admin Tom Smith logged in.
```
