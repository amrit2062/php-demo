<?php

require_once __DIR__ . '/../vendor/autoload.php';

use App\Http\Request;
use App\Http\Response;
use App\Utils\ParameterBag;

$request = Request::createFromGlobals();



$routes = [
    'GET' => [

        '/' => function (Request $request): Response {

            $errors = new ParameterBag();

            return (new Response())->setTemplate(__DIR__ . '/../templates/signin.html.php', [
                'request' => $request,
                'errors' => $errors
            ]);
        },
        '/amrit' => function (Request $request): Response {
            return (new Response())->setTemplate(__DIR__ . '/../templates/amrit.html.php', [
                'name' => 'Amrit'
            ]);
        },
        '/123' => function (Request $request): Response {
            return new Response(200, '123');
        }
    ],
    'POST' => [

        '/signin' => function (Request $request): Response {

            $errors = [];

            $username = $request->post->get('username');
            $password = $request->post->get('password');

            if (!$username) {
                $errors['username'] = 'Username is required.';
            }

            if (!$password) {
                $errors['password'] = 'Password is required.';
            }

            if (filter_var($username, FILTER_VALIDATE_EMAIL) === false) {
                $errors['username'] = 'Username must be a valid email address.';
            }

            if (strlen($password) < 8) {
                $errors['password'] = 'Password must be at least 8 characters long.';
            }

            if (!empty($errors)) {
                $errors = new ParameterBag($errors);

                return (new Response(400))->setTemplate(__DIR__ . '/../templates/signin.html.php', [
                    'request' => $request,
                    'errors' => $errors
                ]);
            }



            return new Response(200, 'Sign-in page');
        },

        '/contact-me' => function (Request $request): Response {
            // .....
        }
    ]
];


$method = $request->method(); 

$path = $request->pathinfo();

$handler = $routes[$method][$path] ?? null;

if ($handler) {
    $response = $handler($request);
} else {
    $response = new Response(404, 'Not Found');
}

$response->send();
