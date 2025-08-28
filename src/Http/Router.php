<?php

declare(strict_types=1);

namespace App\Http;

class Router 
{
    private array $routes = [
        'GET' => [],
        'POST' => []
    ];

    public function get(string $pathinfo, callable|string $controller) {

        $this->routes['GET'][$pathinfo] = $controller;
        return $this;
    }

    public function post(string $pathinfo, callable|string $controller) {
        $this->routes['POST'][$pathinfo] = $controller;
        return $this;
    }

    public function handle(Request $request): Response
    {
        $method = $request->method(); 

        $path = $request->pathinfo();

        $controller = $this->routes[$method][$path] ?? null;

        if (!$controller) {
            return new Response(404, "Not found!");            
        }

        if (is_string($controller)) {
            $parts = explode('@', $controller);
            $className = $parts[0];
            $methodName = $parts[1];

            $object = new $className;
            return $object->{$methodName}($request);
        }

        return $controller($request);

    }

}