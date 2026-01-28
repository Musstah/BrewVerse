<?php


/**
 * Get the base path
 * 
 * @param string $path
 * @return string
 */
function dirPath($path = '')
{
    return __DIR__ . '/' . $path;
}


/**
 * Inspect value(s)
 * 
 * @param mixed $value
 * @return void
 */
function inspect($value)
{
    echo '<pre>';
    var_dump($value);
    echo '</pre>';
}

/**
 * Inspect value(s) and die
 * 
 * @param mixed $value
 * @return void
 */
function inspectAndDie($value)
{
    echo '<pre>';
    die(var_dump($value));
    echo '</pre>';
}

/**
 * Format salary
 * 
 * @param string $salary
 * @return string Formatted Salary
 */
function formatPrice($salary)
{
    return '$' . number_format(floatval($salary));
}

/**
 * Sanitize data, if is_string the just sanitize, if array it loops loop through and sanitizes each string
 * 
 * @param string $dirty
 * @return string 
 */
function sanitize($dirty)
{
    return is_string($dirty)
        ? filter_var(trim($dirty), FILTER_SANITIZE_SPECIAL_CHARS) : $dirty;
    // : (is_array($dirty)
    //     ? array_map(
    //         fn($item) => filter_var(trim($item), FILTER_SANITIZE_SPECIAL_CHARS),
    //         $dirty
    //     )
    //     : $dirty
    // );
}

/**
 * Redirect to a given url
 * 
 * @param string $url
 * @return void
 */
function redirect($url)
{
    header("Loaction: {$url}");
    exit;
}
