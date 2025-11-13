<?php
// Conexión a la base de datos
echo "<h2>🔌 Conexión a MariaDB</h2>";

$host = 'db';  // Nombre del servicio en docker-compose
$dbname = 'tienda';
$username = 'root';
$password = 'root';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    echo "<p class='success'>✅ Conexión exitosa a la base de datos</p>";

    // Corrección de sintaxis SQL: se elimina el segundo "ORDER BY"
    $stmt = $pdo->prepare("SELECT * FROM producto ORDER BY precio < ?, precio");
    $stmt->execute([3.00]);
    $baratos = $stmt->fetchAll(PDO::FETCH_ASSOC); // Correcto, usa fetchAll para múltiples resultados

    foreach ($baratos as $barato) {
        echo "<p class='info'>{$barato['nombre']} - {$barato['precio']}</p>";
    }

    // Corrección de sintaxis SQL: se añade "WHERE"
    $stmt = $pdo->prepare("SELECT * FROM producto WHERE categoria_id = ?");
    $stmt->execute([2]);
// Corrección de lógica PHP: se usa fetchAll para obtener todos los productos
    $productos = $stmt->fetchAll(PDO::FETCH_ASSOC);

    foreach ($productos as $producto) {
        echo "<p class='info'>{$producto['nombre']} - {$producto['categoria_id']}</p>";
    }

    $stmt = $pdo->prepare("SELECT * FROM producto WHERE stock < ?");
    $stmt->execute([20]);
// Corrección de lógica PHP: se usa fetchAll para obtener múltiples resultados
    $stock_bajo = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Se recomienda usar un nombre de variable diferente para la colección y el elemento
    foreach ($stock_bajo as $item) {
        echo "<p class='info'>{$item['nombre']} - {$item['stock']}</p>";
    }

    $stmt = $pdo->query("SELECT COUNT(*) as total FROM producto");
    $resultado = $stmt->fetch(PDO::FETCH_ASSOC);
    $total = $resultado['total'];

    echo "<p class='info'>Total: $total</p>";

} catch (PDOException $e) {
    echo "<p class='error'>❌ Error de conexión: " . $e->getMessage() . "</p>";
    echo "<div class='info'>";
    echo "<strong>Verifica que:</strong><br>";
    echo "- Los contenedores estén corriendo: <code>docker compose -f docker-compose-alumnos.yml ps</code><br>";
    echo "- El servicio de base de datos esté disponible<br>";
    echo "- Las credenciales sean correctas";
    echo "</div>";
}
?>

