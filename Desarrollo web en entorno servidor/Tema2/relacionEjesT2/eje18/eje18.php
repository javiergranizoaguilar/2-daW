<?php
function numerosPrimosRelativos($number1)
{
    $arrayNumber1=[];
    $aux=0;
    for ($i=1;$i<=$number1;$i++){
        if($number1%$i===0){
            $arrayNumber1[]+=$i;
        }
    }
    return (count($arrayNumber1)===2)&&
    ($arrayNumber1[0]===1 && $arrayNumber1[1]===$number1)?"Es Primo":"No es primo";

}
echo numerosPrimosRelativos(17);
?>