<?php


abstract class Figura
{
    protected $color;

    /**
     * @param $color
     */
    public function __construct($color)
    {
        $this->color = $color;
    }

    abstract function calcularArea(): float;

    public function obtenerColor(){
        return $this->color;
    }
}