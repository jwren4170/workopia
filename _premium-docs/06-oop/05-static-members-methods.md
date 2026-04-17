# Static Members & Methods

So far, we've only seen instance methods and instance variables. These are methods and variables that belong to an instance of a class. For example, if we have a `User` class, we can create many new instances of that user. However, there are cases where we don't need multiple instances and we want to create a method or variable that belongs to the class itself, not to an instance of the class. These are called static methods and static variables.

Let's create a new class called `MathUtility` and add a static property called `$pi` and a static method called `add`. We do this by just adding the `static` keyword before the property or method name:

```php
class MathUtility
{
    public static $pi = 3.14159;

    public static function add(...$nums)
    {
        return array_sum($nums);
    }
}
```

Now we can access the static property and method without creating a new instance of the class:

```php
echo MathUtility::$pi; // 3.14159
```

Notice the way that we access the static property. We use the class name followed by the scope resolution operator `::` and then the property name. This is different than the arrow operator `->` that we use to access instance properties and methods.

You can probably see the reason we made this property static. We don't need multiple instances of the `MathUtility` class. We only need one instance of the `$pi` property. We can access it from anywhere in our code without having to create a new instance of the class.

Let's try the static method:

```php
echo MathUtility::add(1, 2, 3, 4, 5); // 15
```

Again, we use the class name followed by the scope resolution operator `::` and then the method name. We don't need to create a new instance of the class to use the method.
