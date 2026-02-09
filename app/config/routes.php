<?php

use app\middlewares\SecurityHeadersMiddleware;
use flight\Engine;
use flight\net\Router;
use app\controllers\PageController;
use app\controllers\UserController;
use app\controllers\MessageController;
/** 
 * @var Router $router 
 * @var Engine $app
 */

// This wraps all routes in the group with the SecurityHeadersMiddleware
$router->group('', function (Router $router) use ($app) {

    $loginController = new LoginController();
    $router->post('/login', [$loginController, 'login']);
    $router->post('/register', [$loginController, 'register']);

}, [SecurityHeadersMiddleware::class]);