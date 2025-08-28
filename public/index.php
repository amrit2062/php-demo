<?php

define('TEMPLATE_PATH', __DIR__ . '/../templates/');

require_once __DIR__ . '/../vendor/autoload.php';


use App\Controllers\LoginController;
use App\Controllers\PagesController;
use App\Http\Request;
use App\Http\Response;
use App\Http\Router;

$request = Request::createFromGlobals();


$router = new Router();

$router->get('/login', LoginController::class . '@showLoginPage');
$router->post('/login', LoginController::class . '@loginUser');
$router->get('/amrit', PagesController::class . '@homePage');

$router->get('/', function (Request $request): Response {
    return new Response(200, 'Hello, World!');
});


$response = $router->handle($request);

$response->send();
