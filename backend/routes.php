<?php



$router->get('/', 'controllers/home.php');
$router->get('/api/coffee', 'controllers/coffee/show.php');
$router->get('/api/singlecoffee', 'controllers/coffee/showSingle.php');
$router->get('/api/singlepastry', 'controllers/pastries/showSingle.php');
$router->get('/api/pastries', 'controllers/pastries/show.php');
