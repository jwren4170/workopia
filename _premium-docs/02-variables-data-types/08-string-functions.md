# String Functions

I know that we have not talked about creating functions yet. We will get to that very soon, but for now, I want to show you some common functions that have to do with strings that are built into PHP. This is not an exhaustive list, but it is a good start.

## strlen

The `strlen` function returns the length of a string. It takes one parameter, the string to check.

```php
echo strlen('Hello World'); // 11
```

## str_word_count

The `str_word_count` function returns the number of words in a string. It takes one parameter, the string to check.

```php
echo str_word_count('Hello World'); // 2
```

## strrev

The `strrev` function reverses a string. It takes one parameter, the string to reverse.

```php
echo strrev('Hello World'); // dlroW olleH
```

## strpos

The `strpos` function finds the position of the first occurrence of a substring in a string. It takes two parameters, the string to search and the substring to find.

```php
echo strpos('Hello World', 'World'); // 6
```

## substr

The `substr` function returns a part of a string. It takes three parameters, the string to get the substring from, the starting position, and the length of the substring.

```php
echo substr('Hello World', 6, 5); // World
```

## str_replace

The `str_replace` function replaces all occurrences of the search string with the replacement string. It takes three parameters, the string to search, the string to find, and the string to replace it with.

```php
echo str_replace('World', 'Universe', 'Hello World'); // Hello Universe
```

## strtolower

The `strtolower` function converts a string to lowercase. It takes one parameter, the string to convert.

```php
echo strtolower('Hello World'); // hello world
```

## strtoupper

The `strtoupper` function converts a string to uppercase. It takes one parameter, the string to convert.

```php
echo strtoupper('Hello World'); // HELLO WORLD
```

## ucwords

The `ucwords` function converts the first character of each word in a string to uppercase. It takes one parameter, the string to convert.

```php
echo ucwords('hello world'); // Hello World
```

## trim

The `trim` function removes whitespace from the beginning and end of a string. It takes one parameter, the string to trim.

```php
echo trim('   Hello World   '); // Hello World
```

If you want a more exhaustive list of string functions, you can find them in the [PHP documentation](https://www.php.net/manual/en/ref.strings.php).
