<?php

namespace nrv\core\domain\entities\auth;

use nrv\core\domain\entities\Entity;
use nrv\core\dto\auth\AuthDTO;

class Auth extends Entity
{
    protected string $email;
    protected int $role;
    protected string $password;

    /**
     * @param string $ID
     * @param string $email
     * @param string $password
     * @param int $role
     */
    public function __construct(string $ID, string $email, string $password, int $role)
    {
        $this->ID = $ID;
        $this->email = $email;
        $this->password = $password;
        $this->role = $role;
    }

    /**
     * TRANSFORME L'ENTITY EN DTO
     * @return AuthDTO
     */
    public function toDTO(): AuthDTO
    {
        return new AuthDTO($this->ID, $this->email, $this->role);
    }
}