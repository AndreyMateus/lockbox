<?php

namespace Core\Helpers;

class Session
{
    public static function get(string $key, mixed $default = null): string | null
    {
        return $_SESSION[$key] ?? $default;
    }

    public static function set(string $key, mixed $value): void
    {
        $_SESSION[$key] = $value;
    }

    public static function forget(string $key)
    {
        unset($_SESSION[$key]);
    }
}
