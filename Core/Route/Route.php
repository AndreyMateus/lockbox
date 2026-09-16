<?php

namespace Core\Route;

class Route
{
    public array $routes = [];

    public function addRoute(string $httpMethod, string $route, string $controller, mixed $middleware, string $method = '__invoke'): void
    {
        $this->routes[$httpMethod][$route] = [
            'class' => $controller,
            'method' => $method,
            'middleware' => $middleware
        ];
    }

    public function get(string $route, string | array $controller,  mixed $fnMiddleware = null): Route
    {
        //! Para controller string 
        if (is_string($controller)) {
            $this->addRoute('GET', $route, $controller, $fnMiddleware);
        }

        // ! Para controller array, quando já souber o método que vai executar,
        if (is_array($controller)) {
            $class = $controller['class'];
            $methodOfClass = $controller['method'];
            $middleware = $controller['middleware'] ?? null;

            // opção de executar a middleware por argumento, ao invés de passar pelo array.
            if (isset($fnMiddleware)) {
                $middleware = $fnMiddleware;
            }

            $this->addRoute('GET', $route, $class, $middleware, $methodOfClass);
        }

        return $this;
    }

    public function post(string $route, string | array $controller, mixed $fnMiddleware = null): Route
    {
        //! Para elementos únicos - string nome do controller - método padrão
        if (is_string($controller)) {
            $this->addRoute('POST', $route, $controller, $fnMiddleware);
        }

        // ! Para arrays quando já souber o método que vai executar - substituido por enquanto pelo valor default do param method no addRoute()
        if (is_array($controller)) {
            $class = $controller['class'];
            $methodOfClass = $controller['method'];
            $middleware = $controller['middleware'] ?? null;

            // opção de executar a middleware por argumento, ao invés de passar pelo array.
            //? OBS: ela sobreescreve a middleware passada pelo array controller na chave ['middleware'].
            if (isset($fnMiddleware)) {
                $middleware = $fnMiddleware;
            }

            $this->addRoute('POST', $route, $class, $middleware, $methodOfClass);
        }


        return $this;
    }

    public function put(string $route, string | array $controller, mixed $fnMiddleware = null): Route
    {
        if (is_string($controller)) {
            $this->addRoute('PUT', $route, $fnMiddleware, $controller);
        }

        if (is_array($controller)) {
            $class = $controller['class'];
            $methodOfClass = $controller['method'];
            $middleware = $controller['middleware'] ?? null;

            // opção de executar a middleware por argumento, ao invés de passar pelo array.
            if (isset($fnMiddleware)) {
                $middleware = $fnMiddleware;
            }

            $this->addRoute('PUT', $route, $class, $middleware, $methodOfClass);
        }

        return $this;
    }

    public function delete(string $route, string | array $controller, mixed $fnMiddleware = null): Route
    {
        if (is_string($controller)) {
            $this->addRoute('DELETE', $route, $fnMiddleware, $controller);
        }

        if (is_array($controller)) {
            $class = $controller['class'];
            $methodOfClass = $controller['method'];
            $middleware = $controller['middleware'] ?? null;

            // opção de executar a middleware por argumento, ao invés de passar pelo array.
            if (isset($fnMiddleware)) {
                $middleware = $fnMiddleware;
            }

            $this->addRoute('DELETE', $route, $class, $middleware, $methodOfClass);
        }

        return $this;
    }

    public function run(): void
    {

        // para HTTP-VERBS não existentes
        $httpMethod = $this->routes[request_method()] ?? [];

        // para rotas não existentes
        $routeExists = key_exists(uri(), $httpMethod);
        if (!$routeExists) {
            view('404', 'guest');
            die();
        }

        if (isset($this->routes[request_method()]) && isset($this->routes[request_method()][uri()])) {
            $controller = $this->routes[request_method()][uri()];

            $class = new $controller['class'];
            $methodOfClass = $controller['method'];
            $middleware = $controller['middleware'] ?? null;

            if (isset($middleware)) {
                $middleware();
            }

            $class->$methodOfClass();
        }
    }
}
