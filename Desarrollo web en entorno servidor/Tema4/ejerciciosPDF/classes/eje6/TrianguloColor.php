<?php
include_once "Figura.php";
class TrianguloColor extends Figura
{
    public $ladoA {
        set {
            if ($value < 0) {
                throw new Exception("El Alto no puede ser negativo");
            }
            $this->ladoA = $value;
        }
        get => $this->ladoA;
    }
    public $ladoB {
        set {
            if ($value < 0) {
                throw new Exception("El Ancho no puede ser negativo");
            }
            $this->ladoB = $value;
        }
        get => $this->ladoB;
    }
    public $ladoC {
        set {
            if ($value < 0) {
                throw new Exception("El Ancho no puede ser negativo");
            }
            $this->ladoC = $value;
        }
        get => $this->ladoC;
    }
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

    /**
     * @param $ladoA
     * @param $ladoB
     * @param $ladoC
     * @param $alto
     * @param $ancho
     */
    public function __construct($ladoA, $ladoB, $ladoC, $alto, $ancho,$color)
    {
        $this->ladoA = $ladoA;
        $this->ladoB = $ladoB;
        $this->ladoC = $ladoC;
        $this->alto = $alto;
        $this->ancho = $ancho;
        parent::__construct($color);

    }

    public function calcularArea(): float
    {
        return ($this->alto * $this->ancho)/2;
    }

}