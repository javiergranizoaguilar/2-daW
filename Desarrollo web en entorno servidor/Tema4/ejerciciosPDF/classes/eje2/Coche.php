<?php


class Coche extends veiculo
{
    private $puerta;

    public function __construct($marca, $modelo, $anio, $puerta)
    {
        parent::__construct($marca, $modelo, $anio);
        $this->puerta = $puerta;
    }

    public function getCoche()
    {
        $this->getVeiculo();
        echo "Puerta: " . $this->puerta;
    }
}