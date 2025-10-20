<?php
    $arrays = [1,22,99,23];
    function Higer(){
    global $arrays;
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
    echo Higer();
?>
