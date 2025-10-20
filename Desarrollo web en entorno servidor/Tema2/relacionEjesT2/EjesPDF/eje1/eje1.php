<?php
/*
Crear una calculadora simple que realice operaciones básicas (suma, resta,
multiplicación, división) utilizando funciones.

Ampliar la calculadora para incluir operaciones como potencia, raíz cuadrada y módulo.
Implementar manejo de errores con excepciones.
 */
function pedirNumero($n)
{
    $number=null;
    do {
        //ctype_digit() returnea true si solo contiene numeros
        ctype_digit($a=readline("Dame el $n numero:"))?$number=$a:$number=null;
    }while($number===null);
    return $number;
}
function pedirFuncion()
{
    $funcion=null;
    do {
        //ctype_alpha() returnea true si solo contiene Letras
        //ctype_punch() returnea true si solo contiene Signos
        ctype_alpha($a=readline("Sumar o +, Restar o -, Multiplicar o * o X, Dividir o /, Modulo o %, Elevar o ^, Raiz :"))
        ||ctype_punct($a)?$funcion=$a:$funcion=null;
    }while($funcion===null);
    return $funcion;
}
function calculadora($n1,$n2,$f)
{
    return match($f){
        'Sumar','sumar','+' => $n1 + $n2,
        'Restar','restar','-' => $n1 - $n2,
        'Multiplicar','multiplicar','*','X' => $n1 * $n2,
        'Dividir','dividir','/' => $n2!==0? $n1/$n2 : 0,
        'Modulo','modulo','%' => $n2!==0? $n1%$n2 : 0,
        'Elevar','elevar','^' => $n1 ** $n2,
        'Raiz','raiz' => $n1>=0?sqrt($n1):"No se puede hacer la raiz de un numero negativo",
        default => "Has escrito mal cualquiera de las funciones, esto es lo que as escrito: $f",
    };
}

echo calculadora(
    pedirNumero("primero"),
    pedirNumero("segundo"),
    pedirFuncion());
?>