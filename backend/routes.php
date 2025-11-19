<?php



$router->get('/', 'controllers/home.php');
$router->get('/api/coffee', 'controllers/coffee/show.php');
$router->get('/api/pastries', 'controllers/pastries/show.php');
