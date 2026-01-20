<?php

require('../helpers.php');
require('../Router.php');
require('../Database.php');
require('../cors.php');



// Instatiate the router
$router = new Router();

// Get routes
$routes = require('../routes.php');

// Get current URI and HTTP method
$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$method = $_SERVER['REQUEST_METHOD'];
// inspectAndDie($uri);
// Route request
$router->route($uri, $method);
