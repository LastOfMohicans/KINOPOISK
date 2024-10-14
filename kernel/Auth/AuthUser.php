<?php

namespace App\Kernel\Auth;

class AuthUser
{
    public function __construct(
        private int $id,
        private string $name,
        private string $email,
        private string $password,
    ) {
    }
    /**
     * Return this $id
     *
     * @return integer
     */
    public function id(): int
    {
        return $this->id;
    }
    /**
     * Return this $email
     *
     * @return string
     */
    public function email(): string
    {
        return $this->email;
    }
    /**
     * Return this password
     *
     * @return string
     */
    public function password(): string
    {
        return $this->password;
    }

    public function name(): string
    {
        return $this->name;
    }
}
