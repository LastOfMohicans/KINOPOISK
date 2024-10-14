<?php

namespace App\Controllers;

use App\Kernel\Controller\Controller;
use App\Kernel\Interfaces\ViewInterface;
use App\Kernel\View\View;

class LoginController extends Controller
{
    /**
     * Return view with name login
     *
     * @return mixed
     */
    public function index(): void
    {
        $this->view(name: 'login', title: 'Вход');
    }

    public function login(): void
    {
        $email = $this->request()->input('email');
        $password = $this->request()->input('password');

        $login = $this->auth()->attempt($email, $password);
        if ($login) {           
            $this->redirect('/');
        }

        $this->session()->set('error', 'Неверный логин или пароль');
        $this->redirect('/login');
    }

    public function logout(): mixed
    {
        $this->auth()->logout();

        return $this->redirect('/login');

    }
}
