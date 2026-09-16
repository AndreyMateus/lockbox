<?php

namespace App\Middlewares;

//? guest é a middleware do usuário usuário logado.
class GuestMiddleware
{

    public static function handle()
    {
        if (auth()) {
            return redirect('/dashboard');
        }
    }
}
