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
