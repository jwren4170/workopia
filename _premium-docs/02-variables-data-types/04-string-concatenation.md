# String Concatenation, Interpolation, and Escaping

So we have established that PHP has different data types. In this lesson, I want to focus on strings and something called `string concatenation`. This is a fancy way of saying that we can join strings together. I'm also going to show you a big difference between single quotes and double quotes. For now, we are going to focus on single quotes. Which is what I prefer to use. It's completely up to you on which one you use. My main language is JavaScript and I always use single quotes. So I've become accustomed to it. But I will show you the difference between the two when it comes to `concatenation` and something called `variable interpolation`.

Let's create two variables:

```php
$firstName = 'John';
$lastName = 'Doe';
```

I want to create a third variable that will hold the full name. you may think I could do something like this:

```php
$fullName = $firstName $lastName;
echo $fullName;
```

This will give me an error of `Parse error: syntax error, unexpected '$lastName' (T_VARIABLE)`. This is because PHP doesn't know what to do with the space between the two variables. It's expecting an operator. So how do we join these two strings together? If you're coming from JavaScript, you may say use the `+` operator. Let's try that:

```php
$fullName = $firstName + $lastName;
echo $fullName;
```

This gives us an error of something like `Unsupported operand types: string + string`. This is because PHP doesn't use the `+` operator to join strings together. Instead, we use the `.` operator. Let's try that:

```php
$fullName = $firstName . $lastName;
echo $fullName;
```

There we go. That will give us `JohnDoe`. But we probably want a space between the first and last name. So let's add that:

```php
$fullName = $firstName . ' ' . $lastName;
echo $fullName;
```

You may want to insert a string variable into another string. We could do the following:

```php
echo 'Hello, my name is ' . $fullName;
```

We get `Hello, my name is John Doe`.

We can even concatenate the line break instead of echoing it on it's own line:

```php
echo 'Hello, my name is ' . $fullName . '<br>';
```

## Double Quotes & Variable Interpolation

Now I am going to show you the big difference between single quotes and double quotes. If you want to use a variable within a string and you don't want to use concatenation, you can use double quotes. Let's try that:

```php
echo "Hello, my name is $fullName";
```

This should give us the same result without concatenation. 

One thing I want to mention is that single-quoted strings are slightly faster than doing it this way. Reason being, is when you concatenate, it's treated as a literal string and doesn't use interpolation. The difference is generally negligible, but it is there.

You may see this with parentheses around the variable name. This is called `explicit variable interpolation`. It's not necessary, but it's a good practice to get into. Let's try that:

```php
echo "Hello, my name is {$fullName}";
```

It is completely up to you on what you use as far as single and double quotes. Double quotes may seem like the obvious choice, but once you get used to concatenation, it's not bad.

## Escaping Characters

There may be times when you want to use a single quote within a string. You may think you can do the following:

```php
echo 'Hello, my name is 'John'';
```

This will give us an error of `Parse error: syntax error, unexpected 'John', expecting ',' or ';'`. This is because PHP thinks the string ends after `Hello, my name is `. So how do we use a single quote within a string? We can use something called `escaping`. We can escape a single quote by using a backslash `\`. Let's try that:

```php
echo 'Hello, my name is \'John\'';
```

This will give us `Hello, my name is 'John'`. We can also escape double quotes. Let's try that:

```php
echo "Hello, my name is \"John\"";
```
