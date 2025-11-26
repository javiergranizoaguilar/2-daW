<?php

class Veiculo{
    private $marca;
    private $modelo;
    private $anio;

    function __construct($marca, $modelo, $anio){
        $this->marca = $marca;
        $this->modelo = $modelo;
        $this->anio = $anio;
    }
    function getVeiculo(){
        echo "Marca: ".$this->marca ."\n";
        echo "Modelo: ".$this->modelo."\n";
        echo "Anio: ".$this->anio."\n";
    }
}
?>