<?php

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

class Validation
{
    function corretionEmail($email)
    {
        $email=trim($email);
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

    function corretionName(String $name)
    {
        $name=trim($name);
        return preg_match("/^[A-Za-z\s]{2,117}$/", $name) === 1 ?
            "$name es un nombre valido" : "$name no es un nombre valido";
    }

    function corretionPhone($phone)
    {
        $phone=trim($phone);
        return preg_match("/^\d{9}$/", $phone) === 1 ?
            "$phone es un telefono valido" : "$phone no es un telefono valido";
    }

    function corretionPassword($password)
    {
        $password=trim($password);
        return preg_match("/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[\W_]).{8,}$/", $password) === 1 ?
            "$password es un contraseña valido" : "$password no es un contraseña valido";
    }
}
?>