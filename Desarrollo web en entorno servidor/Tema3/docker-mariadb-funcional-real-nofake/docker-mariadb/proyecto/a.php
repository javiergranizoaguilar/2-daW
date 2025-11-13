<?php
// Información de PHP
echo "<h2>📦 Versión de PHP</h2>";
echo "<p class='info'>PHP " . phpversion() . "</p>";

// Conexión a la base de datos
echo "<h2>🔌 Conexión a MariaDB</h2>";

$host = 'db';  // Nombre del servicio en docker-compose
$dbname = 'testdb';
$username = 'alumno';
$password = 'alumno';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    echo "<p class='success'>✅ Conexión exitosa a la base de datos</p>";

    // Obtener versión de MariaDB
    $version = $pdo->query('SELECT VERSION()')->fetchColumn();
    echo "<p class='info'>MariaDB versión: $version</p>";

    // Crear tabla de ejemplo si no existe
    $pdo->exec("
                CREATE TABLE IF NOT EXISTS usuarios (
                    id INT AUTO_INCREMENT PRIMARY KEY,
                    nombre VARCHAR(100) NOT NULL,
                    email VARCHAR(100) NOT NULL,
                    fecha_registro TIMESTAMP DEFAULT CURRENT_TIMESTAMP
                )
            ");

    // Insertar datos de ejemplo si la tabla está vacía
    $count = $pdo->query("SELECT COUNT(*) FROM usuarios")->fetchColumn();
    if ($count == 0) {
        $pdo->exec("
                    INSERT INTO usuarios (nombre, email) VALUES 
                    ('Juan Pérez', 'juan@ejemplo.com'),
                    ('María García', 'maria@ejemplo.com'),
                    ('Carlos López', 'carlos@ejemplo.com')
                ");
        echo "<p class='success'>✅ Datos de ejemplo insertados</p>";
    }

    // Mostrar usuarios
    echo "<h2>👥 Usuarios en la base de datos</h2>";
    $stmt = $pdo->query("SELECT * FROM usuarios ORDER BY id");
    $usuarios = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if (count($usuarios) > 0) {
        echo "<table style='width: 100%; border-collapse: collapse;'>";
        echo "<tr style='background: #f4f4f4;'>";
        echo "<th style='padding: 10px; border: 1px solid #ddd;'>ID</th>";
        echo "<th style='padding: 10px; border: 1px solid #ddd;'>Nombre</th>";
        echo "<th style='padding: 10px; border: 1px solid #ddd;'>Email</th>";
        echo "<th style='padding: 10px; border: 1px solid #ddd;'>Fecha Registro</th>";
        echo "</tr>";

        foreach ($usuarios as $usuario) {
            echo "<tr>";
            echo "<td style='padding: 10px; border: 1px solid #ddd;'>{$usuario['id']}</td>";
            echo "<td style='padding: 10px; border: 1px solid #ddd;'>{$usuario['nombre']}</td>";
            echo "<td style='padding: 10px; border: 1px solid #ddd;'>{$usuario['email']}</td>";
            echo "<td style='padding: 10px; border: 1px solid #ddd;'>{$usuario['fecha_registro']}</td>";
            echo "</tr>";
        }

        echo "</table>";
    }

} catch(PDOException $e) {
    echo "<p class='error'>❌ Error de conexión: " . $e->getMessage() . "</p>";
    echo "<div class='info'>";
    echo "<strong>Verifica que:</strong><br>";
    echo "- Los contenedores estén corriendo: <code>docker compose -f docker-compose-alumnos.yml ps</code><br>";
    echo "- El servicio de base de datos esté disponible<br>";
    echo "- Las credenciales sean correctas";
    echo "</div>";
}
?>