<?php
include "queries.php";
include "createHtmlThings.php";
const ESTATEMENTS =
[
    [
        'title' => 'Ejercicio 1: Crear la BD de Tienda de Frutas',
        'texts' => [
            'Crea una base de datos llamada "tienda_frutas" con las siguientes tablas:',
            'categorias (id, nombre, descripción)',
            'productos (id, nombre, categoria_id, precio, stock)',
            'usuarios (id, nombre, email, contraseña)',
            'pedidos (id, usuario_id, fecha, total)'
        ],
        'hint' => 'Usa PRIMARY KEY, FOREIGN KEY y NOT NULL donde sea necesario'
    ],
    [
        'title' => 'Ejercicio 2: Insertar datos iniciales',
        'texts' => [
            'Inserta al menos 3 categorías (Cítricos, Frutas Rojas, Tropicales) y 10 productos diferentes con sus precios y stock.'
        ],
        'hint' => 'Usa INSERT múltiple para hacerlo más eficiente'
    ],
    [
        'title' => 'Ejercicio 3: Consultas SELECT básicas',
        'texts' => [
            'Escribe consultas PHP para:',
            'a) Obtener todos los productos ordenados por precio (menor a mayor)',
            'b) Obtener productos de una categoría específica',
            'c) Obtener productos con stock menor a 20',
            'd) Contar cuántos productos hay en total'
        ],
        'hint' => 'Usa prepared statements con parámetros (e.g., SELECT * FROM producto WHERE stock < ?)'
    ],
    [
        'title' => 'Ejercicio 4: JOIN - Productos con categoría',
        'texts' => [
            'Escribe una consulta que obtenga el nombre del producto, su precio y el nombre de su categoría. Usa INNER JOIN.',
            'Luego, ordena los resultados por categoría y dentro de cada categoría por precio.'
        ],
        'hint' => 'SELECT p.nombre, p.precio, c.nombre FROM productos p INNER JOIN categorias c ON p.categoria_id = c.id ORDER BY c.nombre, p.precio'
    ],
    [
        'title' => 'Ejercicio 5: UPDATE - Cambiar precios',
        'texts' => [
            'Crea un script PHP que:',
            'a) Aumente el precio de todos los productos de una categoría en un 10%',
            'b) Reduzca el stock de un producto específico cuando se realiza una compra',
            'c) Valide que el stock no sea negativo antes de actualizar'
        ],
        'hint' => 'Usa transacciones (beginTransaction, commit, rollback) para garantizar que ambas operaciones se completen o fallen juntas.'
    ],
    [
        'title' => 'Ejercicio 6: DELETE - Soft Delete',
        'texts' => [
            'Crea un script que elimine productos sin stock (stock = 0). Pero antes, implementa un soft delete añadiendo una columna "eliminado" (BOOLEAN) en la tabla productos.',
            'Luego, modifica tus consultas SELECT para no mostrar productos marcados como eliminados.'
        ],
        'hint' => 'Usa UPDATE en lugar de DELETE para marcar la columna "eliminado" a TRUE.'
    ],
    [
        'title' => 'Ejercicio 7: Simulación de compra (Transacciones)',
        'texts' => [
            'Crea un script que simule una compra:',
            '1. Crear un nuevo pedido para un usuario',
            '2. Reducir el stock del producto(s) comprado(s)',
            '3. Calcular el total del pedido',
            '4. Usar transacciones para garantizar consistencia',
            '5. Manejar errores (stock insuficiente, usuario no existe, etc.)'
        ],
        'hint' => 'Usa try-catch con PDOException, beginTransaction(), commit() y rollback(). Es recomendable crear una tabla `detalle_pedido`.'
    ],
    [
        'title' => 'Ejercicio 8: Reportes y análisis',
        'texts' => [
            'Crea consultas que generen reportes:',
            'a) Productos más vendidos (requiere tabla de detalles de pedidos)',
            'b) Ingresos totales por categoría',
            'c) Productos con bajo stock (< 10 unidades)',
            'd) Usuarios con más compras (cantidad de pedidos)'
        ],
        'hint' => 'Usa GROUP BY, SUM(), COUNT() y ORDER BY para análisis estadístico.'
    ],
    [
        'title' => 'Desafío Extra: Sistema completo',
        'texts' => [
            'Integra todos los conceptos aprendidos para crear un sistema de tienda online básico:',
            '• Gestión de productos (CRUD completo)',
            '• Gestión de usuarios y autenticación',
            '• Carrito de compras con transacciones',
            '• Reportes de ventas y estadísticas',
            '• Manejo robusto de errores'
        ],
        'hint' => 'Este desafío integra conocimientos de PHP, PDO, HTML/CSS y lógica de negocio. No hay una única consulta, es un proyecto completo.'
    ]
];

$host = 'db';  // Nombre del servicio en docker-compose
$dbname = 'tienda';
$username = 'root';
$password = 'root';
$pdo = createConnection();
createEjer();

//eje1
function eje1()
{
    global $pdo;
    try {
        // 1. Crear la Base de Datos (opcional, si ya existe la conexión a 'tienda')
        // Si la conexión ya está en 'tienda', los comandos se ejecutan dentro de esa DB.
        // Para este ejercicio, asumimos que se deben crear las tablas en la BD a la que
        // $initialPDO está conectado (que es 'tienda').

        // 2. Crear las tablas
        echo "<h3>Creando Tablas para Tienda de Frutas...</h3>";

        // Tabla categorias
        $pdo->exec("
            CREATE TABLE IF NOT EXISTS categoria (
                id INT AUTO_INCREMENT PRIMARY KEY,
                nombre VARCHAR(100) NOT NULL,
                descripcion TEXT
            );
        ");
        echo "<p class='success'>✅ Tabla **categorias** creada/verificada.</p>";

        // Tabla productos
        $pdo->exec("
            CREATE TABLE IF NOT EXISTS producto (
                id INT AUTO_INCREMENT PRIMARY KEY,
                nombre VARCHAR(100) NOT NULL,
                categoria_id INT NOT NULL,
                precio DECIMAL(10, 2) NOT NULL,
                stock INT NOT NULL DEFAULT 0,
                FOREIGN KEY (categoria_id) REFERENCES categoria(id) ON DELETE CASCADE
            );
        ");
        echo "<p class='success'>✅ Tabla **productos** creada/verificada.</p>";

        // Tabla usuarios
        $pdo->exec("
            CREATE TABLE IF NOT EXISTS usuario (
                id INT AUTO_INCREMENT PRIMARY KEY,
                nombre VARCHAR(100) NOT NULL,
                email VARCHAR(100) NOT NULL UNIQUE,
                contrasena VARCHAR(255) NOT NULL
            );
        ");
        echo "<p class='success'>✅ Tabla **usuarios** creada/verificada.</p>";

        // Tabla pedidos
        $pdo->exec("
            CREATE TABLE IF NOT EXISTS pedido (
                id INT AUTO_INCREMENT PRIMARY KEY,
                usuario_id INT NOT NULL,
                fecha DATE NOT NULL,
                total DECIMAL(10, 2) NOT NULL,
                FOREIGN KEY (usuario_id) REFERENCES usuario(id) ON DELETE CASCADE
            );
        ");
        echo "<p class='success'>✅ Tabla **pedidos** creada/verificada.</p>";

    } catch (PDOException $e) {
        echo "<p class='error'>❌ Error al crear las tablas: " . $e->getMessage() . "</p>";
    }
}

//eje2
function eje2()
{
    global $pdo;
    try {
        // 1. Insertar Categorías (INSERT múltiple)
        echo "<h3>Insertando Categorías...</h3>";
        $stmt = $pdo->query("SELECT COUNT(*) FROM categoria")->fetchColumn();
        if ($stmt === 0) {
            $pdo->exec("
            INSERT INTO categoria (nombre, descripcion) VALUES
            ('Cítricos', 'Frutas ácidas ricas en vitamina C.'),
            ('Frutas Rojas', 'Bayas y frutas de color rojo, con antioxidantes.'),
            ('Tropicales', 'Frutas de clima cálido, exóticas y dulces.');
        ");
            echo "<p class='success'>✅ 3 categorías insertadas: Cítricos, Frutas Rojas, Tropicales.</p>";
        }
        // 2. Insertar Productos (INSERT múltiple)
        echo "<h3>Insertando Productos...</h3>";
        $stmt = $pdo->query("SELECT COUNT(*) FROM producto")->fetchColumn();
        if ($stmt === 0) {
            $pdo->exec("
            INSERT INTO producto (nombre, categoria_id, precio, stock) VALUES
            ('Naranja', 1, 1.50, 150),       -- Cítricos
            ('Limón', 1, 1.99, 120),         -- Cítricos
            ('Mandarina', 1, 2.20, 90),      -- Cítricos
            ('Fresa', 2, 4.50, 60),          -- Frutas Rojas
            ('Frambuesa', 2, 6.00, 45),      -- Frutas Rojas
            ('Arándano', 2, 5.50, 80),       -- Frutas Rojas
            ('Mango', 3, 3.80, 75),          -- Tropicales
            ('Piña', 3, 2.99, 55),           -- Tropicales
            ('Maracuyá', 3, 7.50, 30),       -- Tropicales
            ('Guayaba', 3, 4.20, 65);        -- Tropicales
        ");
            echo "<p class='success'>✅ 10 productos diferentes insertados.</p>";
        }
    } catch (PDOException $e) {
        // En caso de que se intente insertar dos veces (clave duplicada), o la tabla no exista.
        echo "<p class='error'>❌ Error al insertar datos: " . $e->getMessage() . "</p>";
        echo "<p class='info'>Si el error es de clave duplicada, los datos ya existían. Si es de 'table not found', ejecuta `eje1` primero.</p>";
    }
}

//eje 3
function eje3()
{
    $queries = [
        "SELECT * FROM producto ORDER BY precio < ?, precio",
        "SELECT * FROM producto WHERE categoria_id = ?",
        "SELECT * FROM producto WHERE stock < ?",
        "SELECT COUNT(*) as total FROM producto"
    ];
    $values = [
        3.00, 2, 20, []
    ];
    createTableArrayMultiple(makeSelecQueriesMultiple($queries, $values));

}

//eje 4
function eje4()
{
    $queries = "SELECT p.nombre AS nombre_producto, p.precio,c.nombre AS nombre_categoria FROM producto p INNER JOIN categoria c ON p.categoria_id = c.id ORDER BY nombre_categoria, p.precio;";
    createTableArrayUnitary(makeSelecQueriesUnitari($queries));
}

function eje5()
{
    $selectQueries="SELECT stock FROM producto WHERE id = ? FOR UPDATE";
    $updateQueries=[
        "UPDATE producto SET precio = precio * ? WHERE categoria_id = ?",
        "UPDATE producto SET stock = ? WHERE id = ?"
    ];
    $selectValues=2;
    $updateValues = [
        [
            1.1,1
        ],
        [
            15,$selectValues
        ]
    ];

    createTableArrayUnitary(makeSelecQueriesUnitari($selectQueries,$selectValues));
}
?>

