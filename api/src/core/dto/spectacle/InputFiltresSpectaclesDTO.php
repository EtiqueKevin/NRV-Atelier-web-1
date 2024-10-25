<?php

namespace nrv\core\dto\spectacle;

use nrv\core\dto\DTO;

class InputFiltresSpectaclesDTO extends DTO
{
    protected array $date;
    protected array $style;
    protected array $lieu;
    protected int $page;

    public function __construct(array $date, array $style, array $lieu, int $page)
    {
        $this->date = $date;
        $this->style = $style;
        $this->lieu = $lieu;
        $this->page = $page;
    }
}