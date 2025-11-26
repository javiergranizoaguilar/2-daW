<?php
require_once __DIR__.'/TimeStamp.php';
class Articulo
{
    use TimeStamp;

    private $nombre;
    private $descripcion;
    private $precio;

    /**
     * @param $nombre
     * @param $descripcion
     * @param $precio
     */
    public function __construct($nombre, $descripcion, $precio)
    {
        $this->nombre = $nombre;
        $this->descripcion = $descripcion;
        $this->precio = $precio;
    }
}