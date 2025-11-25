<?php
require('./Veiculo.php');
require('./Coche.php');
require('./CuentaBancaria.php');
int:$ejercicio = (int)readline("Ejercicio: ");

match ($ejercicio){
    1=>ejercicico1(),
    2=>ejercicico2(),
    3=>ejercicico3(),
    default=>ejercicico1(),
};
function ejercicico1()
{
    $veiculo= new Veiculo("volvone","feria",2004);
    $veiculo->getVeiculo();
}
function ejercicico2()
{
    $coche= new Coche("volvone","feria",2004, 4);
    $coche->getCoche();
}
function ejercicico3(){
    $cuentaBancaria= new CuentaBancaria(200);
    echo $cuentaBancaria->consultarSaldo()."\n";
    $cuentaBancaria->depositar(20);
    echo $cuentaBancaria->consultarSaldo()."\n";
    $cuentaBancaria->retirar(30);
    echo $cuentaBancaria->consultarSaldo()."\n";
}
function ejercicico4(){

}
?>