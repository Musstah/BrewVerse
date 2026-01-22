<?php



$router->get('/', 'HomeController@index');



$router->get('/api/coffee', 'coffee\\CoffeeController@index');
$router->get('/api/coffee/{id}', 'coffee\\CoffeeController@show');

$router->post('/api/coffee', 'coffee\\CoffeeController@store');


$router->get('/api/pastry', 'pastries\\PastryController@index');
// $router->get('/api/singlecoffee', 'controllers/coffee/showSingle.php');
// $router->get('/api/singlepastry', 'controllers/pastries/showSingle.php');
// $router->get('/api/pastry', 'controllers/pastries/show.php');
