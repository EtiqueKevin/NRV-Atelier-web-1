<?php

namespace nrv\core\dto\Panier;

use nrv\core\dto\DTO;

class PanierVerifDTO extends DTO
{
    protected string $numero;
    protected string $date;
    protected string $code;


    /**
     * @param string $numero
     * @param string $date
     * @param string $code
     */
    public function __construct(string $numero, string $date, string $code)
    {
        $this->numero = $numero;
        $this->date = $date;
        $this->code = $code;
    }

}