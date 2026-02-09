<?php

use app\middlewares\SecurityHeadersMiddleware;
use flight\Engine;
use flight\net\Router;
use app\controllers\PageController;
use app\controllers\UserController;
use app\controllers\MessageController;
use app\controllers\AuthController;
/** 
 * @var Router $router 
 * @var Engine $app
 */

// This wraps all routes in the group with the SecurityHeadersMiddleware
$router->group('', function (Router $router) use ($app) {


    // $router->get('/register', [AuthController::class, 'showRegister']);
    // $router->post('/register', [AuthController::class, 'postRegister']);
    // $router->post('/validate-register', [AuthController::class, 'validateRegisterAjax']);

    // $router->get('/login', [AuthController::class, 'showLogin']);
    // $router->post('/login', [AuthController::class, 'postLogin']);
    // $router->post('/validate-login', [AuthController::class, 'validateLoginAjax']);

    // $message = new MessageController();
    // $router->get('/message/@id/@id1', [$message, 'charger_messages']);
    // $router->post('/insertMessage', [$message, 'send_message']);

}, [SecurityHeadersMiddleware::class]);