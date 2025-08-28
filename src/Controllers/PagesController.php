<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Http\Request;
use App\Http\Response;

class PagesController extends AbstractController {

    public function homePage(Request $request): Response 
    {
        return $this->render('amrit.html.php', [
            'name' => 'Amrit'
        ]);
    }
}