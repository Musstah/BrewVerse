<?php
session_start();
require __DIR__ . '/../vendor/autoload.php';

require('../helpers.php');
require('../cors.php');

use Framework\Router;


// Instatiate the router
$router = new Router();

// Get routes
$routes = require('../routes.php');

// Get current URI and HTTP method
$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

// inspectAndDie($uri);
// Route request
$router->route($uri);
