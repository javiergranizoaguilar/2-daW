<?php
abstract class Usuario {
    public $id;
    public $nombre;
    public $email;

    /**
     * @param $id
     * @param $nombre
     * @param $email
     */
    public function __construct($id, $nombre, $email)
    {
        $this->id = $id;
        $this->nombre = $nombre;
        $this->email = $email;
    }

    abstract function getTipo():string;
     function getInfo():string{
        return $this->getTipo()."$this->nombre - $this->email";
    }
    abstract function guardar():bool;
}