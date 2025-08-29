<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Http\Request;
use App\Http\Response;
use App\Utils\ParameterBag;


class RegisterController extends AbstractController
{
    public function showRegisterPage(Request $request): Response
    {
        $errors = new ParameterBag();
        return $this->render('register.html.php', [
            'request' => $request,
            'errors' => $errors
        ]);;
    }
    public function registerUser(Request $request): Response
    {
        $errors = [];
        $username = $request->post->get('username');
        $password = $request->post->get('password');


        $FirstName = $request->post->get('FirstName');
        $LastName = $request->post->get('LastName');
        $address = $request->post->get('Address');


        if (!$username) {
            $errors['username'] = 'Username is required';
        }
        if ($password) {
            $errors['password'] = 'Password is  required';
        }
        if (filter_var($username, FILTER_VALIDATE_EMAIL) === false) {
            $errors['username'] = 'Username must be the valid  email address';
        }
        if (strlen($password) < 8) {
            $errors['password'] = 'Password  must  be at least 8 character long.';
        }

        if (empty($FirstName)) {
            $errors['FirstName'] = 'FirstName is required';
        }
        if (empty($LastName)) {
            $errors['LastName'] = 'LastName is required';
        }
        if (empty($address)) {
            $errors['Address'] = 'address is required';
        }
        if (!empty($errors)) {
            $errors = new ParameterBag($errors);
            return $this->render('register.html.php', [
                'request' => $request,
                'errors' => $errors
            ]);
        }




        return $this->render('register.html.php', [
            'request' => $request,
            'errors' => new ParameterBag()
        ]);
    }
}
