<?php
    $arrays = [1,22,99,23];
    echo higer($arrays);
    function higer($array){
    $number=0;
        for($i = 0; $i < count($arrays); $i++){
            if ($i===0){
            $number=$arrays[$i];
            }
            else if ($number<$arrays[$i]){
                    $number=$arrays[$i];
            }
        }
        return $number;
    }

?>
