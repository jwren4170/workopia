# Conditionals In Loops & Break and Continue

We already looked at loops. Loops allow us to repeat a block of code as many times as we want. But what if we want to repeat a block of code only if a certain condition is met? So we already looked at conditionals in order to run a loop. We can also use conditionals inside a loop. Let's look at an example.

```php
$number = 1;

while ($number <= 10) {
    if ($number % 2 == 0) {
        echo $number . ' is even <br>';
    } else {
        echo $number . ' is odd <br>';
    }

    $number++;
}
```

We used a while loop here, but it could be any loop. We are looping through the numbers 1 through 10. We are using a conditional to check if the number is even or odd by using the modulus operator. This works because the modulus operator returns the remainder of a division operation. If the remainder is 0, then the number is even. If the remainder is 1, then the number is odd.

```output
1 is odd
2 is even
3 is odd
4 is even
5 is odd
6 is even
7 is odd
8 is even
9 is odd
10 is even
```

## Break and Continue

Sometimes we want to stop a loop before it is finished. We can do this with the `break` keyword. Let's look at an example:

```php
for ($i = 1; $i <= 10; $i++) {
  if ($i == 5) {
    break;
  }

  echo $i . '<br>';
}
```

We are looping through the numbers 1 through 10. We are using a conditional to check if the number is 5. If it is, we break out of the loop. So the loop will stop when it gets to 5. Let's look at the output:

```output
1
2
3
4
```

## Continue

Sometimes we want to skip an iteration of a loop. We can do this with the `continue` keyword. Let's look at an example:

```php
for ($i = 1; $i <= 10; $i++) {
  if ($i == 5) {
    continue;
  }

  echo $i . '<br>';
}
```

We are looping through the numbers 1 through 10. We are using a conditional to check if the number is 5. If it is, we skip the rest of the code in the loop and go to the next iteration. So the loop will skip 5. Let's look at the output:

```output
1
2
3
4
6
7
8
9
10
```

## Conditional in foreach

Let's look at an example of using a conditional in a foreach loop with an associative array:

```php
$studentGrades = array(
  'John' => 75,
  'Jack' => 92,
  'Jill' => 100,
  'Joan' => 80
);

foreach ($studentGrades as $name => $grade) {
  if ($grade >= 90) {
    echo $name . ' has an excellent grade <br>';
  }
}
```

We are looping through the associative array and checking if the grade is greater than or equal to 90. If it is, we echo that the student has an excellent grade. If not, we echo that the student does not have an excellent grade. Let's look at the output:

```output
Jack has an excellent grade
Jill has an excellent grade

```
