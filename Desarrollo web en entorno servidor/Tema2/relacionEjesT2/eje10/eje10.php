<?php

echo fibonacci(4);
function fibonacci($nesimo){
    $Par=0;
    $Impar=1;
    for($j=1;$j<=$nesimo;$j++){
        $j%2===0?$Par+=$Impar:$Impar+=$Par;

    }
    return $Par<$Impar?$Impar:$Par;
}

?>