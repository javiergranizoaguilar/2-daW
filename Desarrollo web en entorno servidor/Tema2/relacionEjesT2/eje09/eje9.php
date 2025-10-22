<?php

$var=100;
$var2=45;
echo minimoComunMultiplo($var,$var2);



function minimoComunMultiplo($number1,$number2)
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
    return $aux;

}
?>