<?php

namespace App\Kernel\Router;

use App\Kernel\Controller\Controller;
use App\Kernel\Interfaces\AuthInterface;;

use App\Kernel\Interfaces\RedirectInterface;
use App\Kernel\Interfaces\RequestInterface;
use App\Kernel\Interfaces\RouterInterface;
use App\Kernel\Interfaces\SessionInterface;
use App\Kernel\Interfaces\StorageInterface;
use App\Kernel\Interfaces\ViewInterface;
use App\Kernel\Middleware\AbstractMiddleware;

class Router implements RouterInterface
{
    private array $routes = [
        'GET' => [],
        'POST' => []
    ];

    public function __construct(
        private ViewInterface $view,
        private RequestInterface $request,
        private RedirectInterface $redirect,
        private SessionInterface $session,
        private AuthInterface $auth,
        private StorageInterface $storage
    ) {
        $this->initRoutes();
    }

    public function dispatch(string $uri, string $method): void
    {
        $route = $this->findRoute($uri, $method);
        if (!$route) {
            $this->notFound();
        }

        if ($route->hasMiddlewares()) {
            foreach ($route->getMiddlewares() as $middleware) {
                /** @var AbstractMiddleware $middleware */
                $middleware = new $middleware(
                    $this->request,
                    $this->auth,
                    $this->redirect
                );

                $middleware->handle();
            }
        }
        if (is_array($route->getAction())) {
            [$controller, $action] = $route->getAction();
            /** @var Controller $controller */
            $controller = new $controller();

            call_user_func([$controller, 'setView'], $this->view);
            call_user_func([$controller, 'setRequest'], $this->request);
            call_user_func([$controller, 'setRedirect'], $this->redirect);
            call_user_func([$controller, 'setSession'], $this->session);
            call_user_func([$controller, 'setAuth'], $this->auth);
            call_user_func([$controller, 'setStorage'], $this->storage);

            call_user_func([$controller, $action]);
        } else {
            //$route->getAction()();
            call_user_func($route->getAction());
        }
    }

    private function findRoute(string $uri, string $method): Route|false
    {
        if (!isset($this->routes[$method][$uri])) {
            return false;
        }
        return $this->routes[$method][$uri];
    }

    private function notFound(): void
    {
        echo '404 | Not found!!!';
        exit;
    }

    private function initRoutes()
    {
        $routes = $this->getRoutes();
        foreach ($routes as $route) {
            $this->routes[$route->getMethod()][$route->getUri()] = $route;
        }
        //dd($this->routes);
    }

    /**
     * return Route[]
     */
    private function getRoutes(): array
    {
        return require_once APP_PATH . '/config/routes.php';
    }
}
