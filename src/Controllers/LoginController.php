<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Http\Request;
use App\Http\Response;
use App\Utils\ParameterBag;


class LoginController 
{

    public function showLoginPage(Request $request): Response
    {
        $errors = new ParameterBag();

        return (new Response())->setTemplate(TEMPLATE_PATH . 'signin.html.php', [
            'request' => $request,
            'errors' => $errors
        ]);
    }

    public function loginUser(Request $request): Response 
    {
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

            return (new Response(400))->setTemplate(TEMPLATE_PATH.'signin.html.php', [
                'request' => $request,
                'errors' => $errors
            ]);
        }



        return new Response(200, 'Sign-in page');
    }

}