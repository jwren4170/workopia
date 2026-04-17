# Interfaces

Interfaces are similar to abstract classes, but they are not classes. They are a way to define a contract for a class to follow without having to define the implementation. An interface is a collection of abstract methods and constants. A class that implements an interface must implement all the methods and constants defined in the interface. An interface cannot be instantiated. It can only be implemented by a class.

## Example

Let's look at an example. Imagine you're building a content management system (CMS) where you have various types of content, such as articles, videos, and images. Each type of content should have the ability to be displayed and edited. You want to ensure that all content types adhere to a common set of methods for displaying and editing content. You can use an interface to define the contract for displaying and editing content.

#### Define Interface

We use the `interface` keyword to define an interface.

```php
interface ContentInterface {
    public function display();
    public function edit();
}
```

#### Implement Interface

Let's create our `Article` class that implements the `ContentInterface` interface. We use the `implements` keyword to do so:

```php
class Article implements ContentInterface {
    private $title;
    private $content;

    public function __construct($title, $content) {
        $this->title = $title;
        $this->content = $content;
    }

    public function display() {
        echo "<h2>{$this->title}</h2>";
        echo "<p>{$this->content}</p>";
    }

    public function edit() {
        echo "Editing the article '{$this->title}'...";
    }
}
```

Let's create another class called `Video` that implements the `ContentInterface` interface:

```php
class Video implements ContentInterface {
    private $title;
    private $url;

    public function __construct($title, $url) {
        $this->title = $title;
        $this->url = $url;
    }

    public function display() {
        echo "<h2>{$this->title}</h2>";
        echo "<iframe src='{$this->url}'></iframe>";
    }

    public function edit() {
        echo "Editing the video '{$this->title}'...";
    }
}
```

The video class has a `display()` method that displays the video using an iframe.

#### Instantiate Objects

Let's instantiate an `Article` object and a `Video` object:

```php
$article = new Article('Introduction to PHP', 'PHP is a versatile scripting language...');
$video = new Video('PHP For Beginners', 'https://www.youtube.com/watch?v=BUCiSSyIGGU');
```

Let's add the `display()` functions to the template to output:

```php
 <div class="container mx-auto p-4 mt-4">
    <div class="bg-white rounded-lg shadow-md p-6 mt-6">
      <?= $article->display(); ?>
    </div>
    <div class="bg-white rounded-lg shadow-md p-6 mt-6">
      <?= $video->display(); ?>
    </div>
  </div>
```

If you want, you can call the `edit()` method like this:

```php
$article->edit();
$video->edit();
```

So this is an example of how we can use an interface to define a contract for a class to follow. The `Article` and `Video` classes both implement the `ContentInterface` interface, which means they must implement the `display()` and `edit()` methods. This ensures that all content types have the ability to be displayed and edited.
