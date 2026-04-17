# Abstract Classes

An abstract class is a class that is declared abstract — it may or may not include abstract methods. Abstract classes cannot be instantiated, but they can be subclassed. Any class that contains at least one abstract method must also be abstract. Methods defined as abstract simply declare the method's signature; they cannot define the implementation.

Let's look at an example:

```php
abstract class Shape {
    protected $name;

    // Abstract method to calculate area
    abstract public function calculateArea();

    // Constructor
    public function __construct($name) {
        $this->name = $name;
    }

    // Concrete method
    public function getName() {
        return $this->name;
    }
}

```

The above class is an abstract class. It has an abstract method `calculateArea()` and a concrete method `getName()`. The `calculateArea()` method is abstract because we don't know how to calculate the area of a shape. We will leave that to the subclasses to implement. The `getName()` method is concrete because we know how to get the name of a shape.

Let's create a subclass of `Shape`:

```php
// Concrete subclass of Shape
class Circle extends Shape {
    private $radius;

    public function __construct($name, $radius) {
        parent::__construct($name);
        $this->radius = $radius;
    }

    // Implement the abstract method to calculate area for a circle
    public function calculateArea() {
        return pi() * pow($this->radius, 2);
    }
}
```

The above class is a concrete subclass of `Shape`. It implements the abstract method `calculateArea()` to calculate the area of a circle. It also has a constructor to initialize the radius of the circle.

Let's create another subclass of `Shape`:

```php
// Concrete subclass of Shape
class Rectangle extends Shape {
    private $width;
    private $height;

    public function __construct($name, $width, $height) {
        parent::__construct($name);
        $this->width = $width;
        $this->height = $height;
    }

    // Implement the abstract method to calculate area for a rectangle
    public function calculateArea() {
        return $this->width * $this->height;
    }
}
```

The `Rectangle` class is another concrete subclass of `Shape`. It implements the abstract method `calculateArea()` to calculate the area of a rectangle, which is different from the circle.

Let's create an instance of the `Circle` and `Rectangle` classes and call the `calculateArea()` method on them:

```php
// Create instances of concrete classes
$circle = new Circle('Circle', 5);
$rectangle = new Rectangle('Rectangle', 4, 6);

// Call methods on objects
echo $circle->getName() . ' Area: ' . $circle->calculateArea() . '<br>';
echo $rectangle->getName() . ' Area: ' . $rectangle->calculateArea() . '<br>';
```
