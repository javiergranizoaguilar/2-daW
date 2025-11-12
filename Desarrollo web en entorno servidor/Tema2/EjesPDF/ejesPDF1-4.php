<?php
/**
 * Script principal para ejecutar diferentes ejercicios.
 */

// Pide al usuario el número de ejercicio a ejecutar.
$choise = pedirNumero("Dime el ejercicio", 'i');

// Ejecuta la función correspondiente al número elegido.
match ($choise) {
    1 => funcionar1(),
    2 => funcionar2(),
    3 => funcionar3(),
    4 => funcionar4(),
    default => noFuncionar(),
};

/**
 * Muestra un mensaje si el número de ejercicio introducido no existe.
 * @return void
 */
function noFuncionar()
{
    echo "No existe el ejercicio";
}

/*
 *
 *
 *
 * Eje 1 - Calculadora Ampliada
 *
 *
 *
 * */

/**
 * Solicita un número al usuario hasta que se introduzca un valor numérico válido.
 * @param string $text El mensaje a mostrar al usuario.
 * @param string $tipe El tipo de dato a devolver ('i' para int, 'd' para double).
 * @return int|float El número introducido por el usuario, casteado al tipo deseado.
 */
function pedirNumero($text, $tipe)
{
    $number = null;
    do {
        // is_numeric() comprueba si el valor es un número o una cadena numérica.
        is_numeric($a = readline($text)) ? $number = $a : $number = null;
    } while ($number === null);
    // Casteo explícito al tipo de dato solicitado.
    $tipe === 'i' ? $number = (int)$number : $number = (double)$number;
    return $number;
}

/**
 * Solicita la función de la calculadora que el usuario desea usar.
 * @return string La función introducida.
 */
function pedirFuncion()
{
    $funcion = null;
    do {
        // ctype_alpha() verifica letras; ctype_punct() verifica signos de puntuación (operadores).
        $a = readline("Sumar o +, Restar o -, Multiplicar o * o X, Dividir o /, Modulo o %, Elevar o ^, Raiz :");
        if (ctype_alpha($a) || ctype_punct($a)) {
            $funcion = $a;
        } else {
            $funcion = null;
        }
    } while ($funcion === null);
    return $funcion;
}

/**
 * Realiza la operación matemática solicitada entre dos números.
 * @param int|float $n1 Primer número.
 * @param int|float $n2 Segundo número (usado como exponente o divisor).
 * @param string $f Operación a realizar.
 * @return int|float|string Resultado de la operación o mensaje de error.
 */
function calculadora($n1, $n2, $f)
{
    return match ($f) {
        'Sumar', 'sumar', '+' => $n1 + $n2,
        'Restar', 'restar', '-' => $n1 - $n2,
        'Multiplicar', 'multiplicar', '*', 'X' => $n1 * $n2,
        // Manejo de error: la división y el módulo por cero devuelven 0 para evitar errores.
        'Dividir', 'dividir', '/' => $n2 !== 0 ? $n1 / $n2 : 0,
        'Modulo', 'modulo', '%' => $n2 !== 0 ? $n1 % $n2 : 0,
        'Elevar', 'elevar', '^' => $n1 ** $n2,
        // Manejo de error: la raíz cuadrada de un número negativo devuelve un mensaje.
        'Raiz', 'raiz' => $n1 >= 0 ? sqrt($n1) : "No se puede hacer la raiz de un numero negativo",
        default => "Has escrito mal cualquiera de las funciones, esto es lo que as escrito: $f",
    };
}

/**
 * Ejecuta el Eje 1: Calculadora Ampliada.
 * @return void
 */
function funcionar1()
{
    echo calculadora(
        pedirNumero("Primer numero", 'i'),
        pedirNumero("Segundo numero", 'i'),
        pedirFuncion());
}

/*
 *
 *
 *
 *Eje 2 - Clase de Validación
 *
 *
 *
 * */

/**
 * Ejecuta el Eje 2: Prueba de la clase de validación.
 * @return void
 */
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

/**
 * Clase para validar diferentes tipos de datos de usuario (email, nombre, teléfono, contraseña)
 * utilizando expresiones regulares (regex).
 */
class Validation
{
    /**
     * Valida si la cadena es un email válido.
     * @param string $email El email a validar.
     * @return string Mensaje de estado.
     */
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

    /**
     * Valida si la cadena es un nombre válido (solo letras y espacios, de 2 a 117 caracteres).
     * @param string $name El nombre a validar.
     * @return string Mensaje de estado.
     */
    function corretionName(string $name)
    {
        $name = trim($name);
        // Expresión regular que permite letras mayúsculas, minúsculas y espacios, con longitud mínima 2.
        return preg_match("/^[A-Za-z\s]{2,117}$/", $name) === 1 ?
            "$name es un nombre valido" : "$name no es un nombre valido";
    }

    /**
     * Valida si la cadena es un número de teléfono de 9 dígitos.
     * @param string $phone El teléfono a validar.
     * @return string Mensaje de estado.
     */
    function corretionPhone($phone)
    {
        $phone = trim($phone);
        // Expresión regular que exige exactamente 9 dígitos (\d{9}).
        return preg_match("/^\d{9}$/", $phone) === 1 ?
            "$phone es un telefono valido" : "$phone no es un telefono valido";
    }

    /**
     * Valida una contraseña según criterios de seguridad (mínimo 8 caracteres, mayúscula, minúscula, dígito, símbolo).
     * @param string $password La contraseña a validar.
     * @return string Mensaje de estado.
     */
    function corretionPassword($password)
    {
        $password = trim($password);
        // Expresión regular con lookaheads: (?=.*[a-z])(minúscula), (?=.*[A-Z])(mayúscula), (?=.*\d)(dígito), (?=.*[\W_])(símbolo), .{8,}(longitud mínima 8).
        return preg_match("/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[\W_]).{8,}$/", $password) === 1 ?
            "$password es un contraseña valido" : "$password no es un contraseña valido";
    }
}

/*
 *
 *
 *
 *Eje 3 - Gestión de Productos
 *
 *
 *
 * */

/**
 * Ejecuta el Eje 3: Funciones de gestión y filtrado de un array de productos.
 * @return void
 */
function funcionar3()
{
    $productos = [
        ["id" => 1, "nombre" => "Melocotones", "Precio" => 234.45, "Cantidad" => 100],
        ["id" => 2, "nombre" => "Peras", "Precio" => 24.45, "Cantidad" => 14],
        ["id" => 3, "nombre" => "Melones", "Precio" => 34.5, "Cantidad" => 20],
    ];
    filtrarProductos($productos, pedirNumero("Dime el id del Producto", 'i'));
    filtrarProductosParcial($productos, readline("Dime el nombre"));
    sortPedidos($productos);
    seterProductos($productos, pedirNumero("Dime el id del Producto a cambiar", 'i'));
}

/**
 * Filtra el array de productos para mostrar solo el producto con un ID específico.
 * Utiliza array_filter con una función flecha.
 * @param array $productos El array de productos.
 * @param int $id El ID a buscar.
 * @return void
 */
function filtrarProductos($productos, $id)
{
    $aux =array_filter($productos, fn($producto) => $producto["id"] === $id);
    print_r($aux);
}

/**
 * Filtra los productos que contengan un nombre parcial (búsqueda insensible a mayúsculas).
 * @param array $productos El array de productos.
 * @param string $name La subcadena del nombre a buscar.
 * @return void
 */
function filtrarProductosParcial($productos, $name)
{
    $aux = array_filter($productos, fn($producto) => str_contains(strtolower($producto['nombre']), strtolower($name)));
    foreach ($aux as $au) {
        print_r($au);
    }
}

/**
 * Ordena el array de productos por la cantidad.
 * Utiliza usort para la ordenación personalizada.
 * @param array $productos El array de productos (se pasa por valor, no se modifica fuera de la función).
 * @return void
 */
function sortPedidos($productos)
{
    // usort utiliza una función de comparación para ordenar el array.
    // El operador spaceship (<=>) devuelve:
    // -1 si $a es menor que $b (orden ascendente)
    // 0 si son iguales
    // 1 si $a es mayor que $b (orden ascendente)
    usort($productos, fn($a, $b) => $a['Cantidad']- $b['Cantidad']);
    // Nota: El array ordenado ($productos) no se imprime aquí, solo se ordena.
}

/**
 * Permite al usuario modificar el nombre, precio y cantidad de un producto por su ID.
 * @param array $productos El array de productos (el cambio solo afecta a la copia local).
 * @param int $id El ID del producto a modificar.
 * @return void
 */
function seterProductos($productos, $id)
{

    echo "Dime el nuevo nombre";
    $name = readline();
    $price = pedirNumero("Dime el nuevo precio", 'double');
    $amount = pedirNumero("Dime la nueva Cantidad", 'i');

    // Asignación de nuevos valores (asumiendo que $id es el índice en este contexto)
    $productos[$id]['nombre'] = $name;
    $productos[$id]['Precio'] = $price;
    $productos[$id]['Cantidad'] = $amount;

    print_r($productos[$id]);
}

/*
 *
 *
 * Eje4 - Procesador de Texto y N-gramas
 *
 *
 *
 * */
/*
 * Crear un procesador de texto que analice un párrafo y extraiga estadísticas como conteo
 * de palabras, frecuencia de palabras y longitud promedio.
 *
 * Ampliar el procesador para identificar n-gramas (secuencias de n palabras) y detectar
 * frases comunes en el texto.
 * */

/**
 * Ejecuta el Eje 4: Análisis de texto (conteo, frecuencia, longitud promedio) y
 * detección de N-gramas (frases comunes).
 * @return void
 */
function funcionar4()
{
    $text = "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce gravida dui vel urna placerat pharetra ut a velit. Nunc interdum, mauris vel egestas faucibus, felis nunc gravida dui, eget viverra sem neque in leo. Vivamus at nunc at nibh ornare congue ac vel lectus. Curabitur pellentesque, purus viverra rutrum sagittis, lorem elit fringilla libero, in ultricies lorem libero id eros. Aenean quis velit interdum nibh placerat venenatis. Interdum et malesuada fames ac ante ipsum primis in faucibus. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. ";

    // 1. Estadísticas básicas
    contarPalabras($text);
    echo "\nDime una palabra";
    frecuenciaPalabras($text, readline());
    longitudPromedio($text);
    //frecuenciaFrases($text); // Comentado/reemplazado por la solución funcional.

    // 2. Detección de N-gramas (Frases comunes)
    $words = str_word_count($text, 1);
    $maxN = count($words); // Determina la longitud máxima del n-grama posible.

    // Bucle para analizar todos los tipos de N-gramas desde N=1 (palabras) hasta el máximo.
    for ($n = 1; $n <= $maxN; $n++) {
        frecuenciaNgramas($text, $n);
    }
}

/**
 * Cuenta el número total de palabras en el texto.
 * @param string $text El texto a analizar.
 * @return void
 */
function contarPalabras($text)
{
    // str_word_count en modo 0 devuelve el número total de palabras.
    $array = str_word_count($text);
    echo "Ahi $array paralbras en el texto";
}

/**
 * Calcula la frecuencia de una palabra específica en el texto.
 * @param string $text El texto a analizar.
 * @param string $palabra La palabra cuya frecuencia se desea conocer.
 * @return void
 */
function frecuenciaPalabras($text, $palabra)
{

    //str_word_count cuenta las palabras o devuelve un arraycon las palabras
    // str_word_count en modo 1 devuelve un array con todas las palabras.
    $array = str_word_count(strtolower($text), 1);
    // array_count_values cuenta las ocurrencias de cada valor en el array.
    $aux = array_count_values($array)[$palabra] ?? 0;
    echo "numero de veces que se repite la palabra $palabra es $aux";
}

/**
 * Calcula la longitud promedio de las palabras en el texto.
 * @param string $text El texto a analizar.
 * @return void
 */
function longitudPromedio($text)
{
    $array = str_word_count(strtolower($text), 1);
    $aux = 0;
    foreach ($array as $a) {
        $aux += strlen($a);
    }
    // Divide la suma total de longitudes entre el número de palabras.
    $aux /= count($array);
    echo "\nLonguitud promedio de las palabras es: $aux";

}

/**
 * Genera y cuenta la frecuencia de N-gramas (secuencias de N palabras).
 * Muestra SOLO los n-gramas que se repiten (frases comunes, frecuencia > 1).
 * @param string $text El texto a analizar.
 * @param int $n La longitud de la secuencia (N) a buscar.
 * @return void
 */
function frecuenciaNgramas($text, $n)
{
    // Obtener array de palabras en minúsculas
    $words = str_word_count(strtolower($text), 1);
    $totalWords = count($words);
    $ngrams = [];

    if ($totalWords < $n) {
        return;
    }

    // Generar todas las secuencias de $n$ palabras
    // El límite $totalWords - $n$ asegura que siempre haya $n$ palabras restantes
    // para formar un N-grama completo.
    for ($i = 0; $i <= $totalWords - $n; $i++) {
        // array_slice extrae una porción del array desde el índice $i$ con longitud $n$.
        // implode une ese array en una sola frase.
        $ngram = implode(" ", array_slice($words, $i, $n));
        $ngrams[] = $ngram;
    }

    // Contar la frecuencia de cada n-grama
    $frecuencias = array_count_values($ngrams);

    $encontradas = false;

    // Recorre el array asociativo de frecuencias.
    // $frase obtiene la clave (el n-grama); $frecuencia obtiene el valor (el conteo).
    //Primera vez que lo uso Pag 27 tema 1 recordatorio. Que cojones es esto. que fumada.Funcina raro.
    foreach ($frecuencias as $frase => $frecuencia) {
        // Aplica el filtro: solo si la frecuencia es mayor que 1
        if ($frecuencia > 1) {
            if (!$encontradas) {
                echo "\n--- Frases Comunes (N=$n) ---\n";
                $encontradas = true;
            }
            echo "Frase: '$frase', Repeticiones: $frecuencia\n";
        }
    }
}
/*
Fumadon apoteosico de don javier te lo dejo para que observes las fumadas que hago cuando me aburro
function frecuenciaFrases($text)
{
    global $count;
    $array = str_word_count(strtolower($text), 1);
    $arrayRepeat = array_filter(array_count_values($array), fn($a) => $a > 1);

    foreach (array_keys($arrayRepeat) as $a) {
        $aux = array_keys(array_values($array), $a);
        $auxb = [];
        foreach ($aux as $b) {
            $auxb[] = $array[$b + 1] ?? "";
        }
        $auxc = array_count_values($auxb);
        bucleFrases($array, $auxb, $auxc, $count, $a);
    }
    echo "\n$count ddd";
}

function bucleFrases($array, $arrayPosibilities, $number, $count, $firstword)
{
    global $count;
    foreach ($arrayPosibilities as $a) {
        if ($firstword !== $a) {
            $aux = array_keys(array_values($array), $a);
            $auxb = [];
            foreach ($aux as $b) {
                $auxb[] = $array[$b + 1] ?? "";
            }
            $auxc = array_count_values($auxb);
            if ($auxc > 1) {
                //El && sirve para hacer if's cortos de tal manera que si lo primero no es true no se hace lo segundo
                $auxc < $number && $count++;
                bucleFrases($array, $auxb, $auxc, $count, $firstword);
            } else {
                $count++;
            }
        }
    }
}
*/
?>