<?php
$host = '127.0.0.1';
$port = '3328';
$dbname = 'fruteria';
$username = 'alumno';
$password = 'alumno123';
function createConnection()
{
    try {
        global $host,$port ,$dbname, $username, $password;
        $pdo = new PDO("mysql:host=$host;port=$port;dbname=$dbname;", $username, $password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        echo "✅ Conexión exitosa a la base de datos";
        return $pdo;
    } catch (PDOException $e) {
        echo "❌ Error de conexión: " . $e->getMessage() . "\n";
        return null;
    }
}
$pdo = createConnection();
