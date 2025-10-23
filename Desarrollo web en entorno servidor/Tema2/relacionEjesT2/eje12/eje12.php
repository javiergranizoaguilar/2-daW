<?php
if (reverso(validacion())){
    echo "si";
}
else{
    echo "no";
}
function reverso($palabra)
{
    $pAux="";
    for($i=strlen($palabra)-1;$i>=0;$i--){
        $pAux.=substr($palabra,$i,1);
    }
    return $palabra==$pAux;
}
function validacion(){
    do {
        $aux = readline('Dame el numero');
        if(!is_numeric($aux)){echo "no as puesto un numero valido \n";}
    }while (!is_numeric($aux));
    return $aux;
}
?>