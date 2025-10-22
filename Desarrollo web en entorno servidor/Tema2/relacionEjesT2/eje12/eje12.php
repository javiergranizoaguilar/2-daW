<?php
if (reverso(404)){
    echo "si";
}
else{
    echo "no";
}
function reverso($palabra)
{
    $pAux="";
    for($i=strlen($palabra)-1;$i>=0;$i--){
        $pAux.=substr($palabra,$i,1);
    }
    return $palabra==$pAux;
}

?>