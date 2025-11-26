<?php


class Empleado
{
    public float $salario {
        set {
            if ($value < 0) {
                throw new Exception("El precio no puede ser negativo");
            }
            $this->salario = $value;
            $this->salarioAnual = $value * 12;
        }
        get => $this->salario;
    }
    public string $nombre {
        set {
            $this->nombre = $value;
        }
        get => strtoupper($this->nombre);

    }
    public float $salarioAnual {
        get => $this->salarioAnual;
    }

    public function __construct($salario, $nombre)
    {
        $this->salario = $salario;
        $this->nombre = $nombre;
    }
}