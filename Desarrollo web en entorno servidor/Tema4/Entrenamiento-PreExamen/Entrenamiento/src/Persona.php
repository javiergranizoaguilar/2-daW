<?php

abstract class Persona
{

    public int $id;
    public string $nombre;
    public string $email;

    /**
     * @param int $id
     * @param string $nombre
     * @param string $email
     */
    public function __construct(int $id, string $nombre, string $email)
    {
        $this->id = $id;
        $this->nombre = $nombre;
        $this->email = $email;
    }

    abstract function getRol():string;
    function getInfoCompleta():string{
        return "[$this->getRol] $this->nombre $this->email";
    }
}
