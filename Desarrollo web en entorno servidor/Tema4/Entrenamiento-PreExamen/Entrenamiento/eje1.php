<?php
include_once "./src/conexion.php";
include_once "./src/Libro.php";



print"\n";
var_dump(Libro::buscarPorId(1));
print"\n";
var_dump(Libro::buscarTodos());