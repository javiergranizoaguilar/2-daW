<?php

$arraiPI=[1,2,3,4,5,6,7,8,9,10];
print_r(filtroPares($arraiPI));
function filtroPares($arrai){
    $aux=[];
    for ($i=0;$i<count($arrai);$i++){
        if ($arrai[$i]%2===0){
            $aux[]=$arrai[$i];
        }
    }
    return $aux;
}

?>