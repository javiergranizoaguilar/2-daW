<?php

$arrai=[2,3,4];

echo productoArray($arrai);
function productoArray($arrai)
{
    $aux=1;
    for ($i=0;$i<count($arrai);$i++){
        $aux*=$arrai[$i];
    }
    return $aux;
}
?>