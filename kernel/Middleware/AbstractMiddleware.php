<?php

namespace App\Kernel\Middleware;

use App\Kernel\Interfaces\AuthInterface;
use App\Kernel\Interfaces\RedirectInterface;
use App\Kernel\Interfaces\RequestInterface;

abstract class AbstractMiddleware
{
    public function __construct(
        protected RequestInterface $request,
        protected AuthInterface $auth,
        protected RedirectInterface $redirect
    ) {
    }

    abstract public function handle(): void;
}
