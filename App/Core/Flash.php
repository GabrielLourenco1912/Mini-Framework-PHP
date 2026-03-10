<?php

namespace App\Core;

class Flash
{
    private string $KEY = '_flash';

    public function set(string $key, mixed $value): void
    {
        $_SESSION[$this->KEY][$key] = $value;
    }

    public function get(string $key, mixed $default = null): mixed
    {
        if (!isset($_SESSION[$this->KEY][$key])) {
            return $default;
        }

        $value = $_SESSION[$this->KEY][$key];
        unset($_SESSION[$this->KEY][$key]);

        return $value;
    }

    public function has(string $key): bool
    {
        return isset($_SESSION[$this->KEY][$key]);
    }

    public function clear(): void
    {
        unset($_SESSION[$this->KEY]);
    }
}