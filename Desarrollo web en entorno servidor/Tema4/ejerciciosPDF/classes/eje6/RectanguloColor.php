<?php
include_once "Figura.php";
class RectanguloColor extends Figura
{
    public $alto {
        set {
            if ($value < 0) {
                throw new Exception("El Alto no puede ser negativo");
            }
            $this->alto = $value;
        }
        get => $this->alto;
    }
    public $ancho {
        set {
            if ($value < 0) {
                throw new Exception("El Ancho no puede ser negativo");
            }
            $this->ancho = $value;
        }
        get => $this->ancho;
    }
    public function __construct($alto, $ancho,$color){
        $this->alto = $alto;
        $this->ancho = $ancho;
        parent::__construct($color);
    }

    public function calcularArea(): float
    {
        return $this->alto * $this->ancho;
    }


}