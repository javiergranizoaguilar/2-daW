<?php

print_r(validar(['nombre'=>'Juan','edad'=>3]));
function validar($datos)
{
    $datos['nombre']??$datos['nombre']='pan';
    $datos['email']??$datos['email']='pan';
    $datos['edad']??$datos['edad']='pan';
    $datos['ciudad']??$datos['ciudad']='pan';
    return $datos;
}

?>