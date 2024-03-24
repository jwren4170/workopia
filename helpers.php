<?php

define('ASSETS_ROOT', 'http://localhost/workopia/public/assets');
define('SITE_TITLE', 'Workopia');
/**
 * returns the project base url
 *
 * @param string $path
 * 
 * @return string
 * 
 */
function base_path(string $path = ''): string
{
    return __DIR__ . '/' . $path;
}

/**
 * return the specified view
 *
 * @param string $name
 * 
 * @return void
 * 
 */
function load_view(string $name = '', array $data = []): void
{
    $view_path = base_path("App/views/$name.view.php");

    if (file_exists($view_path)) {
        extract($data);
        require_once $view_path;
    } else
        echo "View $name not found";
}

/**
 * return partial view
 *
 * @param string $name
 * 
 * @return void
 * 
 */
function load_partial(string $name = ''): void
{
    $partial_path = base_path("App/views/partials/$name.php");

    if (file_exists($partial_path))
        require_once $partial_path;
    else
        echo "View $name not found";
}

/**
 * Format listing salaries
 *
 * @param mixed $salary
 * 
 * @return string
 * 
 */
function format_salary(mixed $salary): string
{
    $fmt = new NumberFormatter('en_US', NumberFormatter::CURRENCY);
    $fmt->setAttribute(NumberFormatter::FRACTION_DIGITS, 0);
    return $fmt->formatCurrency(floatval($salary), 'USD');
}

/**
 * inspect values without stopping script
 *
 * @param mixed $value
 * 
 * @return void
 * 
 */
function inspect(mixed $value): void
{
    echo '<pre>';
    var_dump($value);
    echo '</pre>';
}

/**
 * inspect values and stop script
 *
 * @param mixed $value
 * 
 * @return void
 * 
 */
function inspect_and_die(mixed $value): void
{
    echo '<pre>';
    die(var_dump($value));
    echo '</pre>';
}

/**
 * Sanatize data
 *
 * @param string $data
 * 
 * @return string
 * 
 */
function sanitize(string $data): string
{
    return filter_var(trim($data), FILTER_SANITIZE_SPECIAL_CHARS);
}

/**
 * Redirect to given url
 *
 * @param string $url
 * 
 * @return void
 * 
 */
function redirect(string $url): void
{
    header("Location: $url");
    exit;
}
