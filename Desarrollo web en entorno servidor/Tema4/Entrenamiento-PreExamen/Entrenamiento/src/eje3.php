<?php
include_once "./GestorPrestamos.php";

$gestor= new GestorPrestamos();
$idPedido=$gestor->registrarPrestamo(2,5);
var_dump( $gestor->getPrestamosActivos(2));
$gestor->registrarDevolucion($idPedido);
var_dump( $gestor->getHistorial(2));