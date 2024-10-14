<?php

namespace App\Kernel\Auth;

use App\Kernel\Controller\Controller;
use App\Kernel\Interfaces\AuthInterface;
use App\Kernel\Interfaces\ConfigInterface;
use App\Kernel\Interfaces\SessionInterface;

class Auth extends Controller implements AuthInterface
{
    public function __construct(
        private SessionInterface $session,
        private ConfigInterface $config
    ) {
    }
    public function attempt(string $username, string $password): bool
    {
        $user = $this->getUser();
        $currentUser = $user->first($this->table(), [
            $this->username() => $username
        ]);

        if (!$currentUser) {
            return false;
        }

        if (!password_verify($password, $currentUser[$this->password()])) {
            return false;
        }

        $this->session->set($this->sessionField(), $currentUser['id']);

        return true;
    }

    public function logout(): void
    {
        $this->session->remove($this->sessionField());
    }

    public function check(): bool
    {
        return $this->session->has($this->sessionField());
    }

    public function user(): ?AuthUser
    {
        if (!$this->check()) {
            return null;
        }

        $user = $this->getUser();
        $table = $this->table();
        $authUser = $user->first($table, [
            'id' => $this->session->get($this->sessionField()),
        ]);

        if ($authUser) {
            return new AuthUser(
                $authUser['id'],
                $authUser['name'],
                $authUser[$this->username()],
                $authUser[$this->password()],
            );
        }

        return null;
    }

    public function table(): string
    {
        return $this->config->getAuth('auth.table', 'users');
    }

    public function username(): string
    {
        return $this->config->getAuth('auth.username', 'email');
    }

    public function password(): string
    {
        return $this->config->getAuth('auth.password', 'password');
    }

    public function sessionField(): string
    {
        return $this->config->getAuth('auth.session_field', 'user_id');
    }

    public function id(): ?int
    {
        return $this->session()->get($this->sessionField());
    }
}
