<?php


// Home controller
$router->get('/', 'HomeController@index');


// Coffee controller url and methods
$router->get('/api/coffee', 'coffee\\CoffeeController@index');
$router->get('/api/coffee/{id}', 'coffee\\CoffeeController@show');
$router->post('/api/coffee', 'coffee\\CoffeeController@store');
$router->delete('/api/coffee/{id}', 'coffee\\CoffeeController@destroy');
$router->get('/api/coffee/edit/{id}', 'coffee\\CoffeeController@edit');
$router->put('/api/coffee/{id}', 'coffee\\CoffeeController@update');

// Pastry controller url and methods
$router->get('/api/pastry', 'pastries\\PastryController@index');
$router->get('/api/pastry/{id}', 'pastries\\PastryController@show');
$router->post('/api/pastry', 'pastries\\PastryController@store');
$router->delete('/api/pastry/{id}', 'pastries\\PastryController@destroy');
$router->get('/api/pastry/edit/{id}', 'pastries\\PastryController@edit');
$router->put('/api/pastry/{id}', 'pastries\\PastryController@update');

// Orders controller url and methods
$router->get('/api/orders', 'orders\\OrdersController@index');
