<?php

class Empleado
{
    private $salario{
        set{
            if ($value < 0) {
                throw new Exception("El precio no puede ser negativo");
            }
            $this->salario = $value;
        }
        get{
            if ($value < 0) {
                throw new Exception("El precio no puede ser negativo");
            }
            $this->salario = $value;
        }
    }
    private $nombre;

    public function __construct($salario, $nombre){
        $this->salario = $salario;
        $this->nombre = $nombre;
    }
}