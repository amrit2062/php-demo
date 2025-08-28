<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Http\Response;

abstract class AbstractController {
    
    protected function render(string $templateName, array $args = []): Response
    {
        return (new Response())->setTemplate(TEMPLATE_PATH . $templateName, $args);
    }
}