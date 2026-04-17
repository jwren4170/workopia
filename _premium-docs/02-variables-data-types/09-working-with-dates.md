# Working With Dates

Again, I know that we have not looked at creating custom functions, but I want to show you how to work with dates using the `date()` function. This is a very common function that you will use in your PHP career.

## The `date()` Function

The `date()` function needs to be passed in what we call an `argument`. We will learn more about function arguments soon. It is basically a value that we pass into the function. In this case, we are passing in a string that tells the `date()` function how to format the date.

Here are the main options:

- `Y` - The year
- `m` - The month
- `d` - The day
- `D` - The day of the week short name
- `l` - The full day of the week name
- `h` - The hour
- `i` - The minute
- `s` - The second
- `a` - AM/PM

### The year

We can pass in a `Y` to get the full year:

```php
date('Y'); // 2023
```

This will give me the current year. If I wanted to get a different year, I could pass in a timestamp as the second argument.

## Timestamps

A timestamp is a number that represents a specific date and time. It is commonly represented as the number of seconds or milliseconds that have elapsed since a specific reference point in time, called the "epoch." The epoch is January 1, 1970, 00:00:00 (UTC).

I will pass in the timestamp for 09/01/1999:

```php
date('Y', 936345600); // 1999
```

Obviously, you are not going to remember the timestamp for 09/01/1999, but you can use the `strtotime()` function to get the timestamp for a specific date.

```php
date('Y', strtotime('1999-09-01')); // 1999
```

So that is how you can work with both the current date and time as well as a specific date and time.

Let's continue to look at the different options that we can pass into the `date()` function.

### The month

We can pass in an `m` to get the month:

```php
date('m'); // 07
```

This will obviously give me the current month since I am not passing in a timestamp.

### The day

We can pass in a `d` to get the day:

```php
date('d'); // 12
```

### The day of the week

We can pass in a `D` to get the day of the week short name and an `l` to get the full day of the week name:

```php
date('D'); // Wed
date('l'); // Wednesday
```

If I wanted to get the year, month, and day, I could pass in `Y-m-d`:

```php
date('Y-m-d'); // 2023-07-12
```

### The hour

We can pass in an `h` to get the hour. This will be in 24-hour format:

```php
date('h');
```

### The minute

We can pass in an `i` to get the minute:

```php
date('i');
```

### The second

We can pass in an `s` to get the second:

```php
date('s');
```

### AM/PM

We can pass in an `a` to get the AM/PM:

```php
date('a');
```

### The full date and time

We can pass in `Y-m-d h:i:s a` to get the full date and time:

```php
date('Y-m-d h:i:s a');
```

You can format the date and time however you want. You can see all of the different options that you can pass into the `date()` function in the [PHP documentation](https://www.php.net/manual/en/function.date.php).
