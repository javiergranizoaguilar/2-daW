<?php

include "./classes/eje1/Veiculo.php";
include "./classes/eje2/Coche.php";
include "./classes/eje3/CuentaBancaria.php";
include "./classes/eje4/Empleado.php";
include "./classes/eje5/Rectangulo.php";
include "./classes/eje5/Triangulo.php";
include "./classes/eje6/RectanguloColor.php";
include "./classes/eje6/TrianguloColor.php";
include "./classes/eje7/Articulo.php";
include "./classes/eje8/Libro.php";
include "./classes/eje8/DVD.php";
include "./classes/eje8/Revista.php";


int:$ejercicio = (int)readline("Ejercicio: ");

match ($ejercicio){
    1=>ejercicio1(),
    2=>ejercicio2(),
    3=>ejercicio3(),
    4=>ejercicio4(),
    5=>ejercicio5(),
    6=>ejercicio6(),
    7=>ejercicio7(),
    8=>ejercicio8(),
    default=>ejercicio1(),
};
function ejercicio1(): void
{
    $veiculo= new Veiculo("volvone","feria",2004);
    $veiculo->getVeiculo();
}
function ejercicio2()
{
    $coche= new Coche("volvone","feria",2004, 4);
    $coche->getCoche();
}
function ejercicio3(){
    $cuentaBancaria= new CuentaBancaria(200);
    echo $cuentaBancaria->consultarSaldo()."\n";
    $cuentaBancaria->depositar(20);
    echo $cuentaBancaria->consultarSaldo()."\n";
    $cuentaBancaria->retirar(30);
    echo $cuentaBancaria->consultarSaldo()."\n";
}
function ejercicio4(){
    $empleado=new Empleado(200,"paco");
    echo $empleado->nombre;
    echo $empleado->salario;
    echo $empleado->salarioAnual;
}
function ejercicio5()
{
    $rectangulo=new Rectangulo(4,4);
    echo $rectangulo->calcularArea();
    echo $rectangulo->calcularPerimetro();
    $triangulo=new Triangulo(2,2,2,4,4);
    echo $triangulo->calcularArea();
    echo $triangulo->calcularPerimetro();
}
function ejercicio6()
{
    $rectangulo=new RectanguloColor(4,4,"cocaina");
    echo $rectangulo->calcularArea();
    echo $rectangulo->obtenerColor();
    $triangulo=new TrianguloColor(2,2,2,4,4,"porros");
    echo $triangulo->calcularArea();
    echo $triangulo->obtenerColor();
}
function ejercicio7()
{
    $articulo=new Articulo("a","s",222);
    $articulo->setFechaCreacion();
    $articulo->setFechaModificacion();
    echo $articulo->getFechaCreacion();
    echo $articulo->getFechaModificacion();
}
function ejercicio8()
{
    $libro=new Libro("a","s","dlhf");
    echo $libro->prestable();
    $libro->prestar();
    echo $libro->prestable();
    $libro->devolver();
    echo $libro->prestable();
    echo $libro->titulo;
    echo $libro->autor;
}
?>