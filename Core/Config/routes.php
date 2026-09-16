<?php

// Route
use Core\Route\Route;

// Middlewares Controllers
use App\Middlewares\AuthMiddleware;
use App\Middlewares\GuestMiddleware;

// Controllers
use App\Controllers\IndexController;
use App\Controllers\LoginController;
use App\Controllers\RegisterController;
use App\Controllers\LogoutController;
use App\Controllers\DashboardController;
use App\Controllers\Notes;
use App\Controllers\ProfileController;
use App\Controllers\InfoController;

$route = new Route();

//! Não autenticados

$route->get('/', IndexController::class, fn() => GuestMiddleware::handle());

$route->get("/register", RegisterController::class, fn() => GuestMiddleware::handle());

$route->post("/register", [
    'class' => RegisterController::class,
    'method' => 'register',
    'middleware' => fn() => GuestMiddleware::handle()
]);

$route->get('/login', LoginController::class, fn() => GuestMiddleware::handle());

$route->post('/login', [
    'class' => LoginController::class,
    'method' => 'login',
    'middleware' => fn() => GuestMiddleware::handle()
]);

//! Autenticadas

$route->get("/logout", LogoutController::class, fn() => AuthMiddleware::handle());

$route->get("/dashboard", DashboardController::class, fn() => AuthMiddleware::handle());

$route->get('/notes/create', [
    'class' => Notes\CreateController::class,
    'method' => 'index',
    'middleware' => fn() => AuthMiddleware::handle()
]);

$route->get('/notes/update', Notes\UpdateController::class, fn() => AuthMiddleware::handle());

// TODO: transferir o caminho de /notes/update para /notes
$route->put('/notes/update', [
    'class' => Notes\UpdateController::class,
    'method' => 'update'
], fn() => AuthMiddleware::handle());

$route->post('/notes/create', [
    'class' => Notes\CreateController::class,
    'method' => 'store'
], fn() => AuthMiddleware::handle());

$route->get('/notes', [
    'class' => Notes\IndexController::class,
    'method' => 'index',
    'middleware' => fn() => AuthMiddleware::handle()
]);

$route->delete("/notes", [
    'class' => Notes\DeleteController::class,
    'method' => '__invoke',
    'middleware' => fn() => AuthMiddleware::handle()
]);

$route->get('/profile', ProfileController::class, fn() => AuthMiddleware::handle());

$route->put('/profile', [
    'class' => ProfileController::class,
    'method' => 'update',
    'middleware' => fn() => AuthMiddleware::handle()
]);

$route->put('/profile/password', [
    'class' => ProfileController::class,
    'method' => 'changePassword'
], fn() => AuthMiddleware::handle());

$route->get('/info', InfoController::class, fn() => AuthMiddleware::handle());

$route->run();
