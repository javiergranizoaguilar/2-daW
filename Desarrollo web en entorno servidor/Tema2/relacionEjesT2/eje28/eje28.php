<?php

$num1=validacion("Primero");
$num2=validacion("Segundo");
$operation=readline("Dame la operacion que quieras hacer (+,-,*,/)");

echo calculadora($num1,$num2,$operation);

function calculadora($num1,$num2,$operador)
{
    return match ($operador) {
        '+'=>$num1+$num2,
        '-'=>$num1-$num2,
        '*'=>$num1*$num2,
        '/'=>$num2!==0?$num1/$num2:0,
        default=>'Ningun operador valido',
    };
}
function validacion($posi){
    do {
        $aux = readline('Dame el ' . $posi . ' numero');
        if(!is_numeric($aux)){echo "no as puesto un numero valido \n";}
    }while (!is_numeric($aux));
    return $aux;
}
?>