<?php

namespace nrv\core\dto;

use JsonSerializable;
use Respect\Validation\Validatable;

abstract class DTO implements JsonSerializable
{

    public function __get(string $name):mixed {
        return property_exists($this, $name) ? $this->$name : throw new \Exception(static::class . ": Property $name does not exist");
    }

    public function jsonSerialize(): array {
        return get_object_vars($this);
    }
}