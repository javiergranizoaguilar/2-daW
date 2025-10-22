<?php

function numeroAmstrong($number){
    $aux=0;
    for ($i=0; $i < strlen($number); $i++) {
        $aux+=substr($number, $i, 1)**3;
    }
    return $aux;
}
echo numeroAmstrong(2344);


?>