<?php

namespace nrv\core\domain\entities;

abstract class Entity
{

    protected ?string $ID=null;

    /**
     * GET MAGIQUE
     * @param string $name
     * @return mixed
     * @throws \Exception
     */
    public function __get(string $name): mixed
    {
        return property_exists($this, $name) ? $this->$name : throw new \Exception(static::class . ": Property $name does not exist");
    }

    /**
     * SET POUR L'ID DE L'ENTTITY
     * @param string $ID
     * @return void
     */
    public function setID(string $ID): void
    {
        $this->ID = $ID;
    }

    /**
     * GETTER DE L'ID DE L'ENTITY
     * @return string|null
     */
    public function getID(): ?string
    {
        return $this->ID;
    }

}