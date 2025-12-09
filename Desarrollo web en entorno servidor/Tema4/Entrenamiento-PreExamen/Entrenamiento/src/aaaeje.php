<?php
$a=[1,2,3,4,5,6,7,8,9,10];
$b=array_map(fn($n)=>$n *1.2,$a);
//$b=array_filter($a,fn($n)=>$n%2==0);
var_dump($b);