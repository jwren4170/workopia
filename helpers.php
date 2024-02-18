<?php

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
function load_view(string $name = ''): void
{
    $view_path = base_path("views/$name.view.php");

    if (file_exists($view_path))
        require_once $view_path;
    else
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
    $partial_path = base_path("views/partials/$name.php");

    if (file_exists($partial_path))
        require_once $partial_path;
    else
        echo "View $name not found";
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