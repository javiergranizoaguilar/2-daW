<?php
$var=validacion();
echo sumaDigitos($var);
function sumaDigitos($number)
{
    $aux=0;
    for($i=0;$i<strlen($number);$i++){
        //$aux=+(int)substr($number,$i,1); esto nome da fallo ni aviso, por que?
        $aux+=(int)substr($number,$i,1);

    }
    return $aux;
}
function validacion(){
    do {
        $aux = readline('Dame el numero');
        if(!is_numeric($aux)){echo "no as puesto un numero valido \n";}
    }while (!is_numeric($aux));
    return $aux;
}
?>