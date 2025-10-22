<?php
$arra1=[2,3,4,5,6];
$arra2=[2,3,9,5,6];

comparar($arra1, $arra2);
function comparar($a,$b)
{
    $aux=[];
    for ($i=0;$i<count($a);$i++){
        $aux[$i]=($a[$i]===$b[$i]);
    }
    for ($i=0;$i<count($aux);$i++){
        echo $aux[$i]."\n";
    }
    return $aux;
}
?>