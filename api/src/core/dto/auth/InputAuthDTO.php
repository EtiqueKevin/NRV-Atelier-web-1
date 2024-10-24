<?php

namespace nrv\core\dto\auth;

class InputAuthDTO extends DTO
{
    protected string $email;
    protected string $password;

    public function __construct(string $email, string $password) {
        $this->email = $email;
        $this->password = $password;
    }

}