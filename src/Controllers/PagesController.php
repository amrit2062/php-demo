<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Http\Request;
use App\Http\Response;

class PagesController {

    public function homePage(Request $request): Response 
    {
        return (new Response())->setTemplate(TEMPLATE_PATH . 'amrit.html.php', [
                'name' => 'Amrit'
            ]);
    }
}