<?php

namespace nrv\core\dto\auth;

use nrv\core\dto\DTO;

class InputAuthDTO extends DTO
{
    protected string $email;
    protected string $password;

    public function __construct(string $email, string $password) {
        $this->email = $email;
        $this->password = $password;
    }

}