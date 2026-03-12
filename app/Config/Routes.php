<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'PizzaController::index');

$routes->get('/pizzas', 'PizzaController::index');
$routes->get('/pizza/create', 'PizzaController::create');
$routes->get('/pizza/delete/(:num)', 'PizzaController::delete/$1');
$routes->post('/pizza/save', 'PizzaController::save');
$routes->get('/pizza/edit/(:num)', 'PizzaController::edit/$1');
$routes->post('/pizza/save/(:num)', 'PizzaController::save/$1');
//
$routes->get('/ingredients', 'IngredientController::index');
$routes->get('/ingredient/create', 'IngredientController::create');
$routes->get('/ingredient/delete/(:num)', 'IngredientController::delete/$1');
$routes->post('/ingredient/save', 'IngredientController::save');
$routes->get('/ingredient/edit/(:num)', 'IngredientController::edit/$1');
$routes->post('/ingredient/save/(:num)', 'IngredientController::save/$1');
//
$routes->get('/pizza/ingredients/(:num)', 'GarnitureController::index/$1');
$routes->get('/pizza/ingredient/create/(:num)', 'GarnitureController::create/$1');
$routes->get('/pizza/ingredient/delete/(:num)', 'GarnitureController::delete/$1');
$routes->post('/pizza/ingredient/save', 'GarnitureController::save');
$routes->get('/pizza/ingredient/edit/(:num)', 'GarnitureController::edit/$1');
$routes->post('/pizza/ingredient/save/(:num)', 'GarnitureController::save/$1');


