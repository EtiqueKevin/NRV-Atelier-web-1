<?php

namespace nrv\core\dto\auth;

use nrv\core\dto\DTO;

class AuthDTO extends DTO
{
    protected string $id;
    protected string $email;
    protected int $role;
    protected ?string $accessToken;
    protected ?string $refreshToken;

    /**
     * @param string $id
     * @param string $email
     * @param int $role
     * @param string|null $accessToken
     * @param string|null $refreshToken
     */
    public function __construct(string $id, string $email, int $role, ?string $accessToken = null, ?string $refreshToken = null) {
        $this->id = $id;
        $this->email = $email;
        $this->role = $role;
        $this->accessToken = $accessToken;
        $this->refreshToken = $refreshToken;
    }
}