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


    $pageController = new PageController();
    // $router->get('/', [$pageController, 'redirectIndex']);
    $router->get('/index', [$pageController, 'redirectIndex']);

    $router->get('/users', [$pageController, 'users']);

    $message = new MessageController();
    $router->get('/message/@id/@id1', [$message, 'charger_messages']);
    $router->post('/insertMessage', [$message, 'send_message']);

}, [SecurityHeadersMiddleware::class]);