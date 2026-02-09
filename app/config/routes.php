<?php

use app\middlewares\SecurityHeadersMiddleware;
use flight\Engine;
use flight\net\Router;
use app\controllers\AuthController;
use app\controllers\AccueilController;
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

    $router->get('/register', [AuthController::class, 'showRegister']);
    $router->post('/register', [AuthController::class, 'postRegister']);
    $router->post('/validate-register', [AuthController::class, 'validateRegisterAjax']);

    $router->get('/login', [AuthController::class, 'showLogin']);
    $router->post('/login', [AuthController::class, 'postLogin']);
    $router->post('/validate-login', [AuthController::class, 'validateLoginAjax']);

    $router->get('/accueil', [AccueilController::class, 'list']);

    // $message = new MessageController();
    // $router->get('/message/@id/@id1', [$message, 'charger_messages']);
    // $router->post('/insertMessage', [$message, 'send_message']);

}, [SecurityHeadersMiddleware::class]);