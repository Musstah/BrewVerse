<?php



$router->get('/', 'HomeController@index');



$router->get('/api/coffee', 'coffee\\CoffeeController@index');
$router->get('/api/coffee/create', 'coffee\\CoffeeController@create');
$router->get('/api/coffee/{id}', 'coffee\\CoffeeController@show');


$router->get('/api/pastry', 'pastries\\PastryController@index');
// $router->get('/api/singlecoffee', 'controllers/coffee/showSingle.php');
// $router->get('/api/singlepastry', 'controllers/pastries/showSingle.php');
// $router->get('/api/pastry', 'controllers/pastries/show.php');
