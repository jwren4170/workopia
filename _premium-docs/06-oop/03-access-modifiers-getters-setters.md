# Access Modifiers & Getters & Setters

In the last lesson, we learned how to create a class with properties, methods and a constructor. In this lesson, we will learn about visibility and access modifiers. Let's look at the class that we created in the last lesson:

```php
class User
{
  public $name;
  public $email;

  public function __construct($name, $email)
  {
    $this->name = $name;
    $this->email  = $email;
  }

  public function login()
  {
    echo 'The user logged in.';
  }
}
```

We have all of our properties and methods set to `public`. This is one of the three available visibility modifiers in PHP. Let's look at all of them and how they work:

- `public` - The property or method can be accessed from anywhere. This is the default visibility modifier. If we do not add any visibility modifier to a property or method, it will be set to `public` by default.
- `protected` - The property or method can be accessed from within the class and any class that inherits from it.
- `private` - The property or method can only be accessed from within the class.

So let's initialize a user and access the `name` property:

```php
$user1 = new User('John Doe', 'john@gmail.com');

echo $user1->name; // John Doe
```

Now let's create a new property called `status`, set the value to `active` and set it to `private`:

```php
class User
{
  public $name;
  public $email;
  private $status = 'active';

  public function __construct($name, $email)
  {
    $this->name = $name;
    $this->email  = $email;
  }

  public function login()
  {
    echo 'The user logged in.';
  }
}
```

Create a new user:

```php
$user1 = new User('John Doe', 'john@gmail.com');
```

and let's try to access the `status` property outside of the class:

```php
echo $user1->status; // Fatal error: Uncaught Error: Cannot access private property User::$status
```

As you can see, we get an error. This is because the property is private. If you try and set it from outside the class, you will get the same error. Let's try it:

```php
$user1->status = 'inactive'; // Fatal error: Uncaught Error: Cannot access private property User::$status
```

If you change the visibility to `protected`, you will get the same result. However, if we were to inherit from the `User` class, we would be able to access the `status` property from within the child class. We will look at inheritance in the next lesson.

## Getters & Setters

You can not directly access the private and protected properties and methods, however, you can create a public method in the class that can access the private property.

Add this method:

```php
 public function getStatus()
  {
    echo $this->status;
  }
```

Now, use that method on your user:

```php
$user1->getStatus(); // active
```

This works because `getStatus` is public and it is within the `User` class, so it has access to the `status` property. So this method **GETS** the property value.

## Setters

At the same time, we can have a public method that let's us set the private property.

Add this method:

```php
// Setter
public function setStatus($status)
{
  $this->status = $status;
}
```

Now you can use that in the global scope:

```php
$user2->setStatus('inactive');
$user2->getStatus(); // inactive
```
