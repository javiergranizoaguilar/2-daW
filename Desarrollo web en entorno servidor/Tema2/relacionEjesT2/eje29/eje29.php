<?php

const FAHRENHEIT_TO_CELSIUS=9/5;
const CELSIUS_TO_FAHRENHEIT=5/9;
const FAHRENHEITH_OUT=32;
const KELVIN=273.15;
$num=validacion();
$temp1=strtolower(readline('Dame en que mides la temperatura'));
$temp2=strtolower(readline('Dame en que quieres combertir la temperatura'));

echo changerTemperarure($num,$temp1,$temp2);

function changerTemperarure($num,$temp1,$temp2)
{
    return match (true){
        $temp1==="celsius"&&$temp2==="fahrenheit"=>($num*FAHRENHEIT_TO_CELSIUS)+FAHRENHEITH_OUT,
        $temp1==="fahrenheit"&&$temp2==="celsius"=>($num-FAHRENHEITH_OUT)*CELSIUS_TO_FAHRENHEIT,
        $temp1==="celsius"&&$temp2==="kelvin"=>$num+KELVIN,
        $temp1==="kelvin"&&$temp2==="celsius"=>$num-KELVIN,
        $temp1==="kelvin"&&$temp2==="fahrenheit"=>(($num-KELVIN)*FAHRENHEIT_TO_CELSIUS)+FAHRENHEITH_OUT,
        $temp1==="fahrenheit"&&$temp2==="kelvin"=>(($num-FAHRENHEITH_OUT)*CELSIUS_TO_FAHRENHEIT)+KELVIN,
        $temp1===$temp2=>$num,
        default=>"No as puesto los nombres de temperatura corectas: ".$temp1." , ".$temp2,
    };
}
function validacion(){
    do {
        $aux = readline('Dame la temperatura');
        if(!is_numeric($aux)){echo "no as puesto un numero valido \n";}
        if(!is_numeric($aux)&&$aux<-459.67){cerok();}
    }while (!is_numeric($aux));
    return $aux;
}
function cerok()
{
    $funcion_actual = __FUNCTION__;
    $linea_error = __LINE__;
    echo "ERROR DE VALIDACIÓN DETECTADO:\n";
    echo "Función afectada: '{$funcion_actual}'\n";
    echo "Línea del código: {$linea_error}\n";
    echo "Mensaje: El valor es demasiado bajo.\n";
}
?>