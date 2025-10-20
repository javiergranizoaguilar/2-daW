<?php

$text="dedede afaf";
$palabra="d";
echo contarLetras($text,$palabra);
    function contarLetras($texto,$letra){
    $number=0;
        for($i=0;$i<strlen($texto);$i++){
            if(substr($texto,$i,1)===$letra){

                $number++;
            }
        }
        return $number;
    }
?>