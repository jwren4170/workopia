# Nested Loops

There may be cases where you need to use a loop inside of another loop. This is called a nested loop. Let's look at an example of a nested `for` loop:

```php
for ($i = 0; $i < 5; $i++) {
    for ($j = 0; $j < 5; $j++) {
        echo $i . ' - ' . $j . '<br>';
    }
}
```

This may look a bit confusing at first. However, if you look at the output, you will see that the inner loop runs 5 times for each iteration of the outer loop. This is a very useful technique.

It is important to make sure that you use a different variable for each loop. In the example above, we are using `$i` for the outer loop and `$j` for the inner loop. If we used `$i` for both loops, the inner loop would overwrite the value of `$i` in the outer loop.

We should see the following output:

```html
0 - 0 0 - 1 0 - 2 0 - 3 0 - 4 1 - 0 1 - 1 1 - 2 1 - 3 1 - 4 2 - 0 ...
```

This is because the inner loop runs 5 times for each iteration of the outer loop and prints the value of `$i` and `$j` each time.

## Nested `while` loops

You can also use nested `while` loops. Let's look at an example:

```php
$i = 0;

while ($i < 5) {
    $j = 0;

    while ($j < 5) {
        echo $i . ' - ' . $j . '<br>';
        $j++;
    }

    $i++;
}
```

This is the same as the nested `for` loop example above. However, it is a bit more verbose. I prefer to use nested `for` loops. However, it is good to know that you can use nested `while` loops as well.

We define the `$j` variable inside of the outer loop. This is because we want to reset the value of `$j` to 0 for each iteration of the outer loop. If we defined `$j` outside of the outer loop, the value of `$j` would not be reset to 0 for each iteration of the outer loop.

This gives us the same exact output as the nested `for` loop example above.

### CSS Grid Example

Let's create a multi-dimensional CSS grid using nested loops.

```php
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>CSS Grid Example</title>
  <style>
    .grid-container {
      display: grid;
      grid-template-columns: repeat(5, 50px); /* Create 5 columns, each 50px wide */
      grid-gap: 5px; /* Add some spacing between grid items */
    }

    .grid-item {
      width: 50px;
      height: 50px;
      background-color: lightblue;
      text-align: center;
      line-height: 50px;
    }
  </style>
</head>
<body>
  <div class="grid-container">
    <?php for ($i = 0; $i < 5; $i++): ?>
      <?php for ($j = 0; $j < 5; $j++): ?>
        <div class="grid-item"><?= $i . ' - ' . $j ?></div>
      <?php endfor; ?>
    <?php endfor; ?>
  </div>
</body>
</html>
```

Here we are doing the same exact thing that we did above except we are outputting a div with some styles.
