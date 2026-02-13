<?php

use app\middlewares\SecurityHeadersMiddleware;
use flight\Engine;
use flight\net\Router;

use app\controllers\UserController;
use app\controllers\AccueilController;
use app\controllers\AuthController;
use app\controllers\CategorieController;
use app\controllers\GestionObjetController;

/** 
 * @var Router $router 
 * @var Engine $app
 */

// This wraps all routes in the group with the SecurityHeadersMiddleware
$router->group('', function (Router $router) use ($app) {

    $auth = new AuthController();

    $router->get('/', [$auth, 'showLogin']);
    $router->post('/login', [$auth, 'postLogin']);
    $router->post('/validate-login', [$auth, 'validateLoginAjax']);
    $router->get('/logout', [$auth, 'logout']);

    $router->get('/register', [$auth, 'showRegister']);
    $router->post('/register', [$auth, 'postRegister']);
    $router->post('/validate-register', [$auth, 'validateRegisterAjax']);

    $router->post('/api/validate/register', [$auth, 'validateRegisterAjax']);

    $userController = new UserController();
    $router->get('/admin', [$userController, 'getAdmin']);

    $accueil = new AccueilController();
    $router->get('/accueil/@id', [$accueil, 'list']);

    $categorie = new CategorieController();
    $router->get('/redirectCategorie', [$categorie, 'redirectInsert']);
    $router->post('/insertCategorie', [$categorie, 'insertCategoriee']);
    $router->get('/editCategorie/@id', [$categorie, 'showEditCategorie']);
    $router->post('/updateCategorie', [$categorie, 'updateCategorie']);
    $router->get('/supprimerCategorie/@id', [$categorie, 'removeCategorie']);

    $gestionobjet = new GestionObjetController();
    $router->get('/gestionobjet/@id', [$gestionobjet, 'afficherMesObjets']);

}, [SecurityHeadersMiddleware::class]);
