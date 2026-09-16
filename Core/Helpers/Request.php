<?php

namespace Core\Helpers;

class Request
{
    public string $method;

    public function __construct()
    {
        $this->method = $_SERVER['REQUEST_METHOD'];
    }

    /**
     * Return a field of form send by request, based on function arguments.
     * @param string $nameInForm
     * @param mixed $return
     */
    public static function getFieldFormByName(string $nameInForm, mixed $return = null): mixed
    {
        return $_REQUEST[$nameInForm] ?? $return;
    }


    /**
     * Return a field of form send by POST request, based on function arguments.
     * @param string $nameInForm
     * @param mixed $return
     */
    public static function getFieldPostFormByName(string $nameInForm, mixed $return = null): mixed
    {
        return $_POST[$nameInForm] ?? $return;
    }
}
