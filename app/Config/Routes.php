<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->setDefaultController('HomeController');
$routes->get('/', 'HomeController::index');

$routes->get('/pizza/(:num)', 'PizzaController::details/$1');
$routes->get('/pizzas', 'PizzaController::index', ['filter' => 'group:admin']);
$routes->get('/pizza/create', 'PizzaController::create', ['filter' => 'group:admin']);
$routes->get('/pizza/delete/(:num)', 'PizzaController::delete/$1', ['filter' => 'group:admin']);
$routes->post('/pizza/save', 'PizzaController::save', ['filter' => 'group:admin']);
$routes->get('/pizza/edit/(:num)', 'PizzaController::edit/$1', ['filter' => 'group:admin']);
$routes->post('/pizza/save/(:num)', 'PizzaController::save/$1');
//
$routes->get('/ingredients', 'IngredientController::index', ['filter' => 'group:admin']);
$routes->get('/ingredient/create', 'IngredientController::create', ['filter' => 'group:admin']);
$routes->get('/ingredient/delete/(:num)', 'IngredientController::delete/$1', ['filter' => 'group:admin']);
$routes->post('/ingredient/save', 'IngredientController::save', ['filter' => 'group:admin']);
$routes->get('/ingredient/edit/(:num)', 'IngredientController::edit/$1', ['filter' => 'group:admin']);
$routes->post('/ingredient/save/(:num)', 'IngredientController::save/$1', ['filter' => 'group:admin']);
//
$routes->get('/pizza/ingredients/(:num)', 'GarnitureController::index/$1 ', ['filter' => 'group:admin']);
$routes->get('/pizza/ingredient/create/(:num)', 'GarnitureController::create/$1', ['filter' => 'group:admin']);
$routes->get('/pizza/ingredient/delete/(:num)', 'GarnitureController::delete/$1', ['filter' => 'group:admin']);
$routes->post('/pizza/ingredient/save', 'GarnitureController::save', ['filter' => 'group:admin']);
$routes->get('/pizza/ingredient/edit/(:num)', 'GarnitureController::edit/$1', ['filter' => 'group:admin']);
$routes->post('/pizza/ingredient/save/(:num)', 'GarnitureController::save/$1', ['filter' => 'group:admin']);
//
$routes->post('/bag/add/(:num)', 'BagController::add/$1');
$routes->get('/bag/checkout', 'BagController::index');
$routes->get('/bag/qty/Inc/(:any)', 'BagController::incQty/$1');
$routes->get('/bag/qty/Dec/(:any)', 'BagController::decQty/$1');
$routes->get('/bag/item/delete/(:any)', 'BagController::deleteItem/$1');
// Routes pour l'API PayPal
$routes->post('api/orders', 'ApiController::createOrder');
$routes->post('api/orders/(:segment)/capture', 'ApiController::captureOrder/$1');

service('auth')->routes($routes);

$routes->get('adminDashboard', 'AdminController::index', ['filter' => 'group:admin']);