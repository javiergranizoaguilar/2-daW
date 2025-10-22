<?php
function reverso($palabra)
{
    $pAux="";
    for($i=strlen($palabra)-1;$i>=0;$i--){
        $pAux.=substr($palabra,$i,1);
    }
    return $pAux;
}
echo reverso("hjg      gg");
?>