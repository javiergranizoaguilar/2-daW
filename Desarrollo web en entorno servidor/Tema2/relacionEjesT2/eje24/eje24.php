<?php
const DESCUENTO_ESTUDIANTES=15;
const DESCUENTO_JUBILADO=20;
const DESCUENTO_VIP=25;

echo calcularDescuentos(readline("Dame el precio"),readline("Dime el descuento: estudiante, jubilado, vip"));
function calcularDescuentos($numero,$descuento){

    return match (strtolower($descuento)) {
        'estudiante'=>calculo($numero,DESCUENTO_ESTUDIANTES),
        'jubilado'=>calculo($numero,DESCUENTO_JUBILADO) ,
        'vip'=>calculo($numero,DESCUENTO_VIP),
        default=>"No as puesto un descuento valido tu precio es $numero"
    };

}
function calculo($n,$d){
    return $n-(($n*$d)/100);
}
?>