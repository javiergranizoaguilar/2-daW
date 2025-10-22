<?php
$arrai="Hola cabronOAEeIIiUUUUUuuuu";

echo eliminaVocales($arrai);

function eliminaVocales($text)
{
    $vocales=["a","A","e","E","i","I","o","O","u","U"];
    $aux=$text;
    foreach ($vocales as $vocal) {
        do {
            if(str_contains($aux, $vocal)) {
                $aux=substr_replace($aux, "", strpos($aux, $vocal), 1);
            }
        }while(str_contains($aux, $vocal));
    }
    return $aux;
}
?>