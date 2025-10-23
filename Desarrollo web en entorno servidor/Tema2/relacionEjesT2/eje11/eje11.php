<?php
function numerosPrimosRelativos($number1,$number2)
{
    $arrayNumber1=[];
    $aux=0;
    for ($i=1;$i<=$number1;$i++){
        if($number1%$i==0){
            $arrayNumber1[]+=$i;
        }
    }
    for ($i=1;$i<=$number2;$i++){
        if($number2%$i==0){
            $aux=in_array($i,$arrayNumber1)?$i:$aux;
        }
    }
    return $aux==1?"Son Primos relativos":"No son primos relativos";

}
function validacion(){
    do {
        $aux = readline('Dame el numero');
        if(!is_numeric($aux)){echo "no as puesto un numero valido \n";}
    }while (!is_numeric($aux));
    return $aux;
}
echo numerosPrimosRelativos(validacion(),validacion());
?>