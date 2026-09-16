<?php

namespace App\Middlewares;

//? Auth é a middleware do usuário não autenticado
class AuthMiddleware
{
    public static function handle()
    {
        return authOrLogin();
    }
}
