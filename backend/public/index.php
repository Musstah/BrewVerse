<?php

require __DIR__ . '/../vendor/autoload.php';

require('../helpers.php');
require('../cors.php');

use Framework\Router;


// This function autoloads Classes, in this case from Framework directory

/**
 * This is commented becausei use psr-4 Autoloader and Composer
 */
// spl_autoload_register(function ($class) {
//     $path = dirPath('Framework/' . $class . '.php');
//     if (file_exists($path)) {
//         require $path;
//     }
// });



// Instatiate the router
$router = new Router();

// Get routes
$routes = require('../routes.php');

// Get current URI and HTTP method
$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

// inspectAndDie($uri);
// Route request
$router->route($uri);
