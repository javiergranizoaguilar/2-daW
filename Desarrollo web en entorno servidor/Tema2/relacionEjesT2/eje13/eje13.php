<?php

emmmetToHtml("sss#rr");
function emmmetToHtml($emmet)
{
    $auxBoolean=false;
    $aux = "<";
    $aux3=0;
    $aux4=0;
    for ($i = 0; $i < strlen($emmet); $i++) {
        $aux.=substr($emmet, $i, 1)==="."?' class="':
            (substr($emmet, $i, 1)==="#"?'" id="':substr($emmet, $i, 1));

        $aux3=substr($emmet, $i, 1)==="."?$i:$aux3;
        $aux4=substr($emmet, $i, 1)==="#"?$i:$aux4;
        $aux3=$aux3<$aux4?($aux3===0?$aux4:$aux3):$aux4;
    }
    $aux2=str_contains($aux,"class=")||str_contains($aux,"id=")?'"></':"></";
    $aux2.=substr($emmet,0,$aux3===0?strlen($emmet):$aux3).">";
    echo $aux.$aux2;
}