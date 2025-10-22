<?php

mosaico(6);
function mosaico($numero)
{
for ($i=1; $i<=$numero; $i++){
    for ($j=1; $j<=$i; $j++){
        echo $i;
    }
    echo "\n";
}
}

?>