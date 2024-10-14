<?php

namespace App\Kernel\Router;

class Route
{
    // private $uri;
    // private $action;

    public function __construct(
        private string $uri,
        private string $method,
        private $action,
        private array $middlewares = []
    ) {
    }

    public static function get(
        string $uri,
        $action,
        array $middlewares = []
    ): static {
        return new static($uri, 'GET', $action, $middlewares);
    }
    public static function post(
        string $uri,
        $action,
        array $middlewares = []
    ): static {
        return new static($uri, 'POST', $action, $middlewares);
    }

    public function getUri(): string
    {
        return $this->uri;
    }

    public function getAction(): mixed
    {
        return $this->action;
    }

    public function getMethod(): string
    {
        return $this->method;
    }

    /**
     * Check not to empty middlewares and return true|false
     *
     * @return boolean
     */
    public function hasMiddlewares(): bool
    {
        return ! empty($this->middlewares);
    }

    /**
     * Get the value of middlewares
     *
     * @return array
     */
    public function getMiddlewares(): array
    {
        return $this->middlewares;
    }
}
