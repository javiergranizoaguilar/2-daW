<?php

$text="cocaina para todos";
echo capitalizar($text);
function capitalizar($text){
    $aux=strtoupper($text[0]);
    for ($i=1; $i < strlen($text); $i++) {
        if(($i===strlen($aux))? true: strtoupper($text[$i])!==$aux[$i]){
        $aux.=$text[$i]===" "? " ".strtoupper($text[$i+1]) : $text[$i];
        }
    }
    return $aux;
}
?>