<?php
$choise = (int)pedirNumero(1);

match ($choise) {
    1 => funcionar1(),
    2 => funcionar2(),
    3 => funcionar3(),
    4 => funcionar4(),
    default => 'Ejercicio desconocido.',
};
/*
 *
 *
 *
 * Eje 1
 *
 *
 *
 * */

/*
Crear una calculadora simple que realice operaciones básicas (suma, resta,
multiplicación, división) utilizando funciones.

Ampliar la calculadora para incluir operaciones como potencia, raíz cuadrada y módulo.
Implementar manejo de errores con excepciones.
 */
function pedirNumero($n)
{
    $number = null;
    do {
        //ctype_digit() returnea true si solo contiene numeros
        ctype_digit($a = readline("Dame el $n numero:")) ? $number = (int)$a : $number = null;
    } while ($number === null);
    return $number;
}

function pedirFuncion()
{
    $funcion = null;
    do {
        //ctype_alpha() returnea true si solo contiene Letras
        //ctype_punch() returnea true si solo contiene Signos
        ctype_alpha($a = readline("Sumar o +, Restar o -, Multiplicar o * o X, Dividir o /, Modulo o %, Elevar o ^, Raiz :"))
        || ctype_punct($a) ? $funcion = $a : $funcion = null;
    } while ($funcion === null);
    return $funcion;
}

function calculadora($n1, $n2, $f)
{
    return match ($f) {
        'Sumar', 'sumar', '+' => $n1 + $n2,
        'Restar', 'restar', '-' => $n1 - $n2,
        'Multiplicar', 'multiplicar', '*', 'X' => $n1 * $n2,
        'Dividir', 'dividir', '/' => $n2 !== 0 ? $n1 / $n2 : 0,
        'Modulo', 'modulo', '%' => $n2 !== 0 ? $n1 % $n2 : 0,
        'Elevar', 'elevar', '^' => $n1 ** $n2,
        'Raiz', 'raiz' => $n1 >= 0 ? sqrt($n1) : "No se puede hacer la raiz de un numero negativo",
        default => "Has escrito mal cualquiera de las funciones, esto es lo que as escrito: $f",
    };
}

function funcionar1()
{
    echo calculadora(
        pedirNumero("primero"),
        pedirNumero("segundo"),
        pedirFuncion());
}

/*
 *
 *
 *
 *Eje 2
 *
 *
 *
 * */
function funcionar2()
{
    $email = "aepo1@gmail.com";
    $name = "holy";
    $phone = "644745523";
    $password = "oierihlQ1.";

    $validatio = new Validation();

    echo $validatio->corretionEmail($email);
    echo "\n";
    echo $validatio->corretionName($name);
    echo "\n";
    echo $validatio->corretionPhone($phone);
    echo "\n";
    echo $validatio->corretionPassword($password);
    echo "\n";
}

class Validation
{
    function corretionEmail($email)
    {
        $email = trim($email);
        //metodo coñazo
        // La expresión regular:
        // /.../ -> Delimitadores de la expresión
        // ^ -> Comienzo de la cadena
        // [\w\.-]+ -> Uno o más caracteres (letras, números, guiones bajos, puntos o guiones)
        // @ -> El símbolo de arroba
        // [\w\.-]+ -> Uno o más caracteres para el dominio
        // \. -> Un punto literal (debe escaparse)
        // [A-Za-z]{2,4} -> De 2 a 4 letras para el TLD (ej: com, es, org)
        // $ -> Fin de la cadena
        $patron = '/^[\w\.-]+@[\w\.-]+\.[A-Za-z]{2,4}$/';
        return preg_match($patron, $email) === 1 ?

            "$email es un email valido" : "$email no es un email valido";
        //Metodo rapido y facil
        //return filter_var($email, FILTER_VALIDATE_EMAIL)!==false;
    }

    function corretionName(string $name)
    {
        $name = trim($name);
        return preg_match("/^[A-Za-z\s]{2,117}$/", $name) === 1 ?
            "$name es un nombre valido" : "$name no es un nombre valido";
    }

    function corretionPhone($phone)
    {
        $phone = trim($phone);
        return preg_match("/^\d{9}$/", $phone) === 1 ?
            "$phone es un telefono valido" : "$phone no es un telefono valido";
    }

    function corretionPassword($password)
    {
        $password = trim($password);
        return preg_match("/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[\W_]).{8,}$/", $password) === 1 ?
            "$password es un contraseña valido" : "$password no es un contraseña valido";
    }
}

/*
 *
 *
 *
 *Eje 3
 *
 *
 *
 * */

function funcionar3()
{
    $productos = [
        ["id" => 1, "nombre" => "Melocotones", "Precio" => 234.45, "Cantidad" => 100],
        ["id" => 2, "nombre" => "Peras", "Precio" => 24.45, "Cantidad" => 14],
        ["id" => 3, "nombre" => "Melones", "Precio" => 34.5, "Cantidad" => 20],
    ];
    filtrarProductos($productos, pedirNumero(1));
    sortPedidos($productos);
}

function filtrarProductos($productos, $id)
{
    $aux =array_filter($productos, fn($producto) => $producto["id"] === $id);
    print_r($aux);
}

function sortPedidos($productos)
{
    // Usamos usort con una función flecha para comparar las "Cantidad"
// El operador spaceship (<=>) devuelve:
// -1 si $a es menor que $b (orden ascendente)
// 0 si son iguales
// 1 si $a es mayor que $b (orden ascendente)
    usort($productos, fn($a, $b) => $a['Cantidad']- $b['Cantidad']);
    echo $productos[0]['Cantidad'];
}

?>