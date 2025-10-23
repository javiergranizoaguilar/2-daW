<?php

echo fibonacci(validacion());
function fibonacci($nesimo){
    $Par=0;
    $Impar=1;
    for($j=1;$j<=$nesimo;$j++){
        $j%2===0?$Par+=$Impar:$Impar+=$Par;

    }
    return $Par<$Impar?$Impar:$Par;
}
function validacion(){
    do {
        $aux = readline('Dame el numero');
        if(!is_numeric($aux)){echo "no as puesto un numero valido \n";}
    }while (!is_numeric($aux));
    return $aux;
}
?>