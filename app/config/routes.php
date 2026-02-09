<?php

use app\middlewares\SecurityHeadersMiddleware;
use flight\Engine;
use flight\net\Router;
/** 
 * @var Router $router 
 * @var Engine $app
 */

// Route par défaut redirige vers login

// This wraps all routes in the group with the SecurityHeadersMiddleware
$router->group('', function (Router $router) use ($app) {

    $router-> get('/', Flight::render('/index', ['baseUrl' => Flight::get('flight.base_url')]));

    $userController = new UserController();
    $router-> get('/', [$userController, 'getAdmin']);
    $router-> get('/login', [$userController, 'login']);
    $router-> post('/register', [$userController, 'register']);
    $router-> get('/accueil', [AccueilController::class, 'list']);


}, [SecurityHeadersMiddleware::class]);