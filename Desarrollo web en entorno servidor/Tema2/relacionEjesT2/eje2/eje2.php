<?php

$arrays=[22,3,2,5,444];
echo suma($arrays);
function suma($numbers)
{
    $n=0;
    foreach ($numbers as $number){
        $n+=$number;
    }
    return $n;
}

?>