<?php
namespace nrv\application\providers\auth;

use Firebase\JWT\JWT;
use Firebase\JWT\Key;

class JWTManager
{
    private $secretKey;
    private $algorithm;


    /**
     * @param $secretKey
     * @param $algorithm
     */
    public function __construct($secretKey, $algorithm = 'HS256')
    {
        $this->secretKey = $secretKey;
        $this->algorithm = $algorithm;
    }

    /**
     * CREE UN TOKEN A PARTIR D'UN PAYLOAD
     * @param array $payload
     * @return string
     */
    public function createAccessToken(array $payload): string{
        $payload['exp'] = time() + 3600;
        return JWT::encode($payload, $this->secretKey, $this->algorithm);
    }

    /**
     * CREE UN TOKEN DE RAFRAICHISSEMENT A PARTIR D'UN PAYLOAD
     * @param array $payload
     * @return string
     */
    public function createRefreshToken(array $payload): string{
        $payload['exp'] = time() + 3600 * 24 * 7;
        return JWT::encode($payload, $this->secretKey, $this->algorithm);
    }

    /**
     * DECODE UN TOKEN
     * @param string $token
     * @return array
     */
    public function decodeToken(string $token): array{
        return (array) JWT::decode($token,new Key( $this->secretKey, $this->algorithm));
    }

}