<?php

namespace App\Controllers;

use App\Kernel\Controller\Controller;

class RegisterController extends Controller
{
    public function index(): void
    {
        $this->view(name: 'register', title: 'Регистрация');
    }

    public function register(): void
    {
        $validation = $this->request()->validate([
            'name' => ['required', 'min:3', 'max:255'],
            'email' => ['required', 'email'],
            'password' => ['required', 'min:8', 'confirmed'],
            'password_confirmation' => ['required', 'min:8'],
        ]);

        if (!$validation) {
            $errors = $this->request()->errors();

            foreach ($errors as $field => $error) {
                $this->session()->set($field, $error);
            }

            $this->redirect('/register');
        } else {
            $user = $this->getUser();
            $userId = $user->insert('users', [
                'name' => $this->request()->input('name'),
                'email' => $this->request()->input('email'),
                'password' => password_hash(
                    $this->request()->input('password'),
                    PASSWORD_DEFAULT
                )
            ]);
        }

        $this->redirect('/');
        //dd('User create with id: ' . $userId);
    }
}
