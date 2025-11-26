<?php
include_once "Calculable.php";
class Rectangulo implements Calculable
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
    public function __construct($alto, $ancho){
        $this->alto = $alto;
        $this->ancho = $ancho;
    }

    public function calcularArea(): float
    {
        return $this->alto * $this->ancho;
    }
    public function calcularPerimetro():float{
        return 2*($this->alto + $this->ancho);
    }

}