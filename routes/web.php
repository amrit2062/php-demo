<?php

use App\Http\Router;
use App\Http\Request;
use App\Http\Response;
use App\Controllers\LoginController;
use App\Controllers\PagesController;

/** @var Router $router */
$router->get('/login', LoginController::class . '@showLoginPage');
$router->post('/login', LoginController::class . '@loginUser');
$router->get('/amrit', PagesController::class . '@homePage');

$router->get('/',PagesController::class.'@homePage');


// $router->get('/', function (Request $request): Response {
//     return new Response(200, '');
// });