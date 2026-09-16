<?php

use App\Models\UserModel;
use Core\Helpers\Request;

/**
 * Dump and die
 * @param mixed $data
 * @return void
 */
function dd(mixed ...$data): void
{
    echo "<pre>";

    foreach ($data as $item) {
        var_dump($item);
    }

    echo "</pre>";

    die();
}

/**
 * GET the path of root folder OR concatenate the root path with the path param.
 * @param string $path
 * @return string
 */
function base_path(string $path = ''): string
{
    // TODO: analisar pq esse codigo CRASHOU na HOSTINGER
    // \\ -> windows

    return convert_separator_of_path(__DIR__ . "\\..\\..\\" . $path);
}

/**
 * Return the method (verb) of request
 * @return string
 */
function request_method(): string
{
    // spoofing for PUT and DELETE VERBS
    $__method = $_POST['__method'] ?? $_SERVER["REQUEST_METHOD"];

    return $__method;
}

/**
 * Load the template file and the view inside of template
 * @param string $viewName
 * @param mixed $data
 * @return void
 */
function view(string $viewName, string $template = 'app', mixed $data = []): void
{
    $viewName = convert_separator_of_path(base_path("App\\Views\\$viewName.view.php"));
    $template = convert_separator_of_path(base_path("App\\Views\\template\\$template.php"));
    include($template);
}

/**
 * Return the actual resource of URL (URI)
 * @return string
 */
function uri(): string
{
    $route = parse_url($_SERVER["REQUEST_URI"])['path'];
    return $route;
}

/**
 * Return if the REQUEST METHOD is the same of param
 * @param string $verb
 * @return bool
 */
function request_method_is(string $verb): bool
{
    return request_method() === $verb;
}

/**
 * Convert the separator directory of path for native separator and return, but depends of your operational system.
 * @param string $path
 * @return string
 * @example BEFORE: C:/users/downloads 
 * @example AFTER: C:\users\downloads (windows)
 */
function convert_separator_of_path(string $path)
{
    // two bars for escape. \\ -> \
    return str_replace("\\", DIRECTORY_SEPARATOR, $path);
}

/**
 * Return a array of DSN configurations
 * @return array
 * @example ['server'] 127.0.0.1
 * @example ['dbname'] database name
 * @example ['port'] port of connection with database
 * @example ['user'] user of database login
 * @example ['password'] password of database login
 */
function config(): array
{
    return require(convert_separator_of_path(base_path("Core/Config/config.php")));
}

/**
 * Mount and return the DSN - based of config.php file.
 * @return string
 */
function getDsn(): string
{
    $config = config();

    $dsn = $config['sgbd'] . ":" . "server=" . $config['server'] . ";" . "dbname=" . $config['dbname'] . ";" . "port=" . $config['port'] . ";";
    return $dsn;
}

/**
 * Redirect the location to the path
 * @return void
 */
function redirect(string $path): void
{
    header("Location:$path");
}

/**
 * Verify if the user are authenticated and return the user or return false
 * @return UserModel|bool
 */
function auth(): UserModel | bool
{
    return $_SESSION["user"] ?? FALSE;
}

/**
 * Return true if user are logged, false if user not has logged AND redirect the user to login page if false
 * @return bool
 */
function authOrLogin(): bool
{
    if (!auth()) {
        redirect("/login");
        return false;
    }

    return true;
}

function request(): Request
{
    return new Request();
}

function automaticSelectMenu(string $uri): string
{
    return uri() == $uri ? 'border border-gray-500' : '';
}

function getProfileImg(string $fullPathImg): string
{
    // OBS: HERE is the PUBLIC PATH of IMG
    return "/uploads/profile_images/" . basename($fullPathImg);
}
