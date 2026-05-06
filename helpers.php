<?php

/**
 * Get the base path
 *
 * @param string $path
 * @return string
 */
function base_path($path = '')
{
    return __DIR__ . '/' . $path;
}

/**
 * Load a view
 *
 * @param string $name
 * @param array $data
 * @return void
 */
function load_view(string $name, array $data = [])
{
    $view_path = base_path("App/views/{$name}.view.php");
    // Make sure path exists
    if (file_exists($view_path)) {
        extract($data);
        require $view_path;
    } else {
        echo "View '{$name}' not found.";
    }
}

/**
 * Load a partial
 *
 * @param string $name
 * @param array $data
 * @return void
 */
function load_partial(string $name, array $data = [])
{
    $partial_path = base_path("App/views/partials/{$name}.php");

    // Make sure path exists
    if (file_exists($partial_path)) {
        extract($data);
        require $partial_path;
    } else {
        echo "Partial '{$name}' not found.";
    }
}

function format_salary(float | string $salary)
{
    $formatter = new NumberFormatter('en-US', NumberFormatter::CURRENCY);
    return ($formatter->formatCurrency((float)$salary, 'USD'));
}

/**
 * Sanitize data
 *
 * @param string $dirty
 * @return string
 */
function sanitize(string $dirty)
{
    return filter_var(trim($dirty), FILTER_SANITIZE_SPECIAL_CHARS);
}

/**
 * Redirect to a given URL
 *
 * @param string $url
 * @return void
 */
function redirect($url)
{
    header("Location: {$url}");
    exit;
}

/**
 * Inspect a value
 *
 * @param array $values
 * @return void
 */
function inspect(mixed $value)
{
    echo '<pre>';
    var_dump($value);
    echo '</pre>';
}

/**
 * Inspect a value
 *
 * @param array $values
 * @return void
 */
function inspect_and_die(mixed $value)
{
    echo '<pre>';
    die(var_dump($value));
}
