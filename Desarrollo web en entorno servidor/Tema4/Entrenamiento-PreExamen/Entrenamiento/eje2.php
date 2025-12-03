<?php
include_once "./src/conexion.php";
include_once "./src/Socio.php";

$s=new Socio(true ,new DateTime(),1,",","43r");
$s->guardar();