<?php

use app\middlewares\SecurityHeadersMiddleware;
use flight\Engine;
use flight\net\Router;
use app\controllers\UserController;
/** 
 * @var Router $router 
 * @var Engine $app
 */

// Route par défaut redirige vers login
$router->get('/', function() {
    Flight::redirect('/login');
});

// This wraps all routes in the group with the SecurityHeadersMiddleware
$router->group('', function (Router $router) use ($app) {


}, [SecurityHeadersMiddleware::class]);