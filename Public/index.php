<?php
date_default_timezone_set("America/Sao_Paulo");

require_once("../Core/Helpers/helpers.php");

//? registrada em memória - durante a requisição atual.
spl_autoload_register(function (string $class) {
    $namespace = "$class.php";
    $fullPathOfClass = base_path() . $namespace;
    include convert_separator_of_path($fullPathOfClass);
});

//! é necessário esperar o autoload - pois a session usará o model para desserializar.
session_start();

require_once(base_path("Core/Config/routes.php"));
