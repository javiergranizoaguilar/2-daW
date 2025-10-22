<?php

function clasificar($numero)
{
    return match ($numero) {
        9,10=>"Sobresaliente",
        7,8=> "Notable",
        5,6=>"Aprobado",
        0,1,2,3,4=>"Suspenso",
    };
}
echo clasificar((int)readline("Nota"))
?>