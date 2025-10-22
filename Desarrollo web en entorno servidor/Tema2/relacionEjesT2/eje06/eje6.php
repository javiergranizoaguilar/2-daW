<?php
$text="dededededede afafdedede afafdedede afafddddd afaf";
$palabra="de";
echo contarLetras($text,$palabra);
function contarLetras($texto,$letra){
    $number=0;
    for($i=0;$i<strlen($texto);$i++){
        if(substr($texto,$i,strlen($letra))===$letra){

            $number++;
        }
    }
    return $number;
}
?>