# Null Coalescing Operator

In the last lesson, we learned about the ternary operator. There is a newer operator as of PHP 7 that is similar to the ternary operator, but it is used to check if a value is null. It is called the null coalescing operator. This will be a quick video, but I wanted to just show you a quick example.

Let's say we want to do this with a ternary operator:

```php
$color = isset($favoriteColor) ? $favoriteColor : 'blue';
```

We can do the same thing with the null coalescing operator:

```php
$color = $favoriteColor ?? 'blue';
```

We can check for multiple values:

The ternary operator:

```php
$color = isset($favoriteColor) ? $favoriteColor : (isset($secondFavoriteColor) ? $secondFavoriteColor : 'blue');
```

Here, we are checking if `$favoriteColor` is set. If it is, we use that value. If it is not, we check if `$secondFavoriteColor` is set. If it is, we use that value. If it is not, we use the string `'blue'`.

The null coalescing operator:

```php
$color = $favoriteColor ?? $secondFavoriteColor ?? 'blue';
```
