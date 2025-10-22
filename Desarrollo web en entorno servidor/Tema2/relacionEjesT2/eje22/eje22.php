<?php

function numeroPerfecto($number){
    $aux=0;
    for ($j=1;$j<$number;$j++){
        if($number%$j===0){
            $aux+=$j;
        }
    }
    return $aux===$number?"Es un numero perfecto":"No es un numero perfecto";
}
echo numeroPerfecto(6);
?>