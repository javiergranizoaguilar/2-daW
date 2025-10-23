<?php
$milles=validacion();
echo mToK($milles);
function mToK($m)
{
    return $m*1.60934;
}
function validacion(){
    do {
        $aux = readline('Dame el numero');
        if(!is_numeric($aux)){echo "no as puesto un numero valido \n";}
    }while (!is_numeric($aux));
    return $aux;
}
?>