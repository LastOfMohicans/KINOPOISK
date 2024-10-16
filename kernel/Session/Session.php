<?php

namespace App\Kernel\Session;

use App\Kernel\Interfaces\SessionInterface;

class Session implements SessionInterface
{
    public function __construct()
    {
        session_start();
    }

    public function set(string $key, $value): void
    {
        $_SESSION[$key] = $value;
    }

    public function get(string $key, $default = null): mixed
    {
        return $_SESSION[$key] ?? $default;
    }

    public function has(string $key): bool
    {
        return isset($_SESSION[$key]);
    }

    public function remove(string $key): void
    {
        unset($_SESSION[$key]);
    }

    public function destroy(): void
    {
        session_destroy();
    }

    public function getFlash(string $key, $default = null): mixed
    {
        $value = $this->get($key, $default);
        $this->remove($key);
        
        return $value;
    }
}
