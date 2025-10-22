<?php
function factorial($number):int
{
    $aux=1;
    for ($i=1;$i<=$number;$i++){
        $aux*=$i;
    }
    return $aux;
}
echo factorial(17);
?>