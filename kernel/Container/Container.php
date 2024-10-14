<?php

namespace App\Kernel\Container;

use App\Kernel\Auth\Auth;
use App\Kernel\Config\Config;
use App\Kernel\Database\Database;
use App\Kernel\Http\Redirect;
use App\Kernel\View\View;
use App\Kernel\Http\Request;
use App\Kernel\Interfaces\AuthInterface;
use App\Kernel\Interfaces\ConfigInterface;
use App\Kernel\Interfaces\DatabaseInterface;
use App\Kernel\Interfaces\RedirectInterface;
use App\Kernel\Interfaces\RequestInterface;
use App\Kernel\Interfaces\RouterInterface;
use App\Kernel\Interfaces\SessionInterface;
use App\Kernel\Interfaces\StorageInterface;
use App\Kernel\Interfaces\ValidatorInterface;
use App\Kernel\Interfaces\ViewInterface;
use App\Kernel\Router\Router;
use App\Kernel\Session\Session;
use App\Kernel\Storage\Storage;
use App\Kernel\Validator\Validator;

class Container
{
    public readonly RequestInterface $request;

    public readonly RouterInterface $router;

    public readonly ViewInterface $view;

    public readonly ValidatorInterface $validator;

    public readonly RedirectInterface $redirect;

    public readonly ConfigInterface $config;

    public readonly SessionInterface $session;

    public readonly AuthInterface $auth;

    public readonly StorageInterface $storage;

    public function __construct()
    {
        $this->registerServices();
    }

    private function registerServices()
    {
        $this->request = Request::createFromGlobals();
        $this->validator = new Validator();
        $this->request->setValidator($this->validator);
        $this->redirect = new Redirect();
        $this->session = new Session();
        $this->config = new Config();
        $this->auth = new Auth($this->session, $this->config);
        $this->storage = new Storage($this->config); 
        $this->view = new View($this->session, $this->auth, $this->storage);
        $this->router = new Router(
            $this->view,
            $this->request,
            $this->redirect,
            $this->session,
            $this->auth,
            $this->storage,
        ); 
                      
    }
}
