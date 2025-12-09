# 💻 EXAMEN FINAL PRÁCTICO - DWES 2025
## Temas 2, 3 y 4 - PHP 8.4, Base de Datos y POO

| **Información del Examen** | |
|---------------------------|---|
| **Valor** | 75% de la nota final |
| **Duración** | 2 horas (teoría + práctica) |
| **Parte Práctica** | 50 puntos |
| **Material permitido** | ✅ CON APUNTES |
| **Fecha** | _________________ |

---

| **Alumno/a** | |
|-------------|---|
| **Nombre** | _________________________________ |
| **Apellidos** | _________________________________ |

---

# 📋 INSTRUCCIONES GENERALES

1. **Tienes acceso a Docker** con MySQL ya configurado. Levanta con: `docker-compose up -d`
2. **Al levantar el contenedor**, la base de datos `fruteria` se crea automáticamente con las tablas precargadas.
3. **Ejecuta tus scripts PHP desde tu instalación local** usando `php archivo.php`
4. **Debes crear tú mismo la conexión PDO** usando las credenciales proporcionadas.
5. **Debes escribir todas las consultas SQL** usando PDO y prepared statements.

---

# 📁 ARCHIVOS PROPORCIONADOS

## docker-compose.yml
```yaml
version: '3.8'
services:
  db:
    image: mysql:8.0
    environment:
      MYSQL_ROOT_PASSWORD: dwes2025
      MYSQL_DATABASE: fruteria
      MYSQL_USER: alumno
      MYSQL_PASSWORD: alumno123
    ports:
      - "3306:3306"
    volumes:
      - ./init.sql:/docker-entrypoint-initdb.d/init.sql
```

## init.sql (se ejecuta automáticamente al levantar el contenedor)
```sql
USE fruteria;

-- Tabla: categorias
CREATE TABLE categorias (
    id INT PRIMARY KEY AUTO_INCREMENT,
    nombre VARCHAR(100) NOT NULL,
    descripcion TEXT
);

-- Tabla: productos
CREATE TABLE productos (
    id INT PRIMARY KEY AUTO_INCREMENT,
    nombre VARCHAR(150) NOT NULL,
    categoria_id INT NOT NULL,
    precio DECIMAL(10,2) NOT NULL,
    stock INT DEFAULT 0,
    activo BOOLEAN DEFAULT TRUE,
    FOREIGN KEY (categoria_id) REFERENCES categorias(id)
);

-- Tabla: clientes
CREATE TABLE clientes (
    id INT PRIMARY KEY AUTO_INCREMENT,
    nombre VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    fecha_registro DATETIME DEFAULT CURRENT_TIMESTAMP
);

-- Tabla: pedidos
CREATE TABLE pedidos (
    id INT PRIMARY KEY AUTO_INCREMENT,
    cliente_id INT NOT NULL,
    fecha DATETIME DEFAULT CURRENT_TIMESTAMP,
    total DECIMAL(10,2) NOT NULL,
    estado ENUM('pendiente', 'procesado', 'enviado', 'entregado') DEFAULT 'pendiente',
    FOREIGN KEY (cliente_id) REFERENCES clientes(id)
);

-- Tabla: detalles_pedido
CREATE TABLE detalles_pedido (
    id INT PRIMARY KEY AUTO_INCREMENT,
    pedido_id INT NOT NULL,
    producto_id INT NOT NULL,
    cantidad INT NOT NULL,
    precio_unitario DECIMAL(10,2) NOT NULL,
    FOREIGN KEY (pedido_id) REFERENCES pedidos(id),
    FOREIGN KEY (producto_id) REFERENCES productos(id)
);

-- Datos iniciales
INSERT INTO categorias (nombre, descripcion) VALUES
('Cítricos', 'Naranjas, limones, pomelos y mandarinas'),
('Frutas Rojas', 'Fresas, frambuesas y arándanos'),
('Tropicales', 'Piñas, mangos y plátanos');

INSERT INTO productos (nombre, categoria_id, precio, stock) VALUES
('Naranjas', 1, 2.50, 100),
('Limones', 1, 2.00, 80),
('Pomelos', 1, 3.00, 50),
('Fresas', 2, 4.50, 40),
('Frambuesas', 2, 5.00, 30),
('Arándanos', 2, 5.50, 25),
('Piña', 3, 3.50, 45),
('Mango', 3, 4.00, 55),
('Plátano', 3, 1.50, 120);

INSERT INTO clientes (nombre, email) VALUES
('Juan García', 'juan@example.com'),
('María López', 'maria@example.com'),
('Carlos Martínez', 'carlos@example.com');
```

---

# ⚠️ IMPORTANTE: Credenciales de conexión

Desde tu PHP local, usa estos datos para conectarte a MySQL (Docker):
- **Host:** `localhost`
- **Puerto:** `3306`
- **Base de datos:** `fruteria`
- **Usuario:** `alumno`
- **Contraseña:** `alumno123`

**Para probar la conexión:** `php src/test_conexion.php`

---

# EJERCICIO 0: Conexión a la Base de Datos (5 puntos)

Crea un archivo `conexion.php` con una función que devuelva una conexión PDO configurada correctamente.

### Requisitos:
1. Función `getConexion(): PDO` que devuelva la conexión
2. Configurar el modo de errores para que lance excepciones
3. Configurar el charset a `utf8mb4`
4. Manejar posibles errores de conexión con try-catch

### Tu código:
```php
<?php
// Escribe tu función de conexión aquí:

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
        echo "Conexión exitosa a la base de datos";
        return $pdo;
    } catch (PDOException $e) {
        echo "Error de conexión: " . $e->getMessage() . "\n";
        return null;
    }
}


```

---

# EJERCICIO 1: Clase Producto con acceso a BD (15 puntos)

Crea la clase `Producto` siguiendo estas especificaciones:

### Requisitos:

1. **Propiedades** (usar Property Hooks de PHP 8.4 donde sea apropiado):
   - `id`: int (solo lectura después de crearse)
   - `nombre`: string (debe guardarse sin espacios al inicio/final)
   - `precio`: float (mínimo 0.01, lanzar excepción si es menor)
   - `stock`: int (mínimo 0)
   - `categoriaId`: int
   - `activo`: bool

2. **Constructor**: Recibe todos los parámetros y los asigna

3. **Métodos de instancia**:
   - `hayStock(): bool` - Devuelve true si stock > 0
   - `reducirStock(int $cantidad): bool` - Reduce el stock si hay suficiente
   - `calcularTotal(int $cantidad): float` - Devuelve precio × cantidad
   - `toArray(): array` - Devuelve un array asociativo con todas las propiedades

4. **Métodos estáticos con consultas SQL SIMPLES** (usa PDO y prepared statements):
   - `findById(int $id): ?Producto` - SELECT * FROM productos WHERE id = ?
   - `findAll(): array` - SELECT * FROM productos (filtra los activos con PHP usando foreach)
   - `save(): bool` - Método de instancia que hace INSERT o UPDATE del producto actual
   
   > ⚠️ **NOTA:** Usa consultas SQL simples. La lógica de filtrado se hace con PHP.

### Tu código:
```php
<?php
<?php
include_once "conexsion.php";

class Producto
{
    private(set) public int $id;
    public string $nombre {
        set(string $value) => $this->nombre = trim($value);
        get => $this->precio = $value;
    }
    public float $precio {
        set(float $value) {
            if ($value < 0.01) {
                throw new Exception("El precio no puede ser menor que 0.01");
            }
            $this->precio = $value;
        }
        get => $this->precio = $value;
    }
    public int $stock {
        set(int $value) {
            if ($value < 0) {
                throw new Exception("El precio no puede ser menor que 0.01");
            }
            $this->precio = $value;
        }
        get => $this->precio = $value;
    }
    public int $categoriaId;
    public bool $activo;

    /**
     * @param int $id
     * @param string $nombre
     * @param float $precio
     * @param int $stock
     * @param int $categoriaId
     * @param bool $activo
     */
    public function __construct(int $id, string $nombre, float $precio, int $stock, int $categoriaId, bool $activo)
    {
        $this->id = $id;
        $this->nombre = $nombre;
        $this->precio = $precio;
        $this->stock = $stock;
        $this->categoriaId = $categoriaId;
        $this->activo = $activo;
    }

    function hayStock(): bool
    {
        return $this->stock > 0;
    }

    function reducirStock(int $cantidad): bool
    {
        if ($this->stock > $cantidad) {
            $this->stock -= $cantidad;
            return true;
        }
        return false;
    }

    function calcularTotal(int $cantidad): float
    {
        return $this->precio * $cantidad;
    }

    function toArray(): array
    {
        return [
            "id" => $this->id,
            "nombre" => $this->nombre,
            "precio" => $this->precio,
            "stock" => $this->stock,
            "categoriaId" => $this->categoriaId,
            "activo" => $this->activo
        ];
    }

    static function findById(int $id): ?Producto
    {
        $pdo = createConnection();
        try {
            $pdo->beginTransaction();
            $stmt = $pdo->prepare("SELECT * FROM productos WHERE id = ?");
            $stmt->execute([$id]);
            $producto = $stmt->fetch(PDO::FETCH_ASSOC);
            return new Producto($producto[$id], $producto["nombre"], $producto["precio"], $producto["stock"], $producto["categoriaId"], $producto["activo"]);

        } catch (PDOException $e) {
            echo $e->getMessage();
            $pdo->rollBack();
            return null;
        }
    }

    static function findAll(): ?array
    {
        $pdo = createConnection();
        try {
            $pdo->beginTransaction();
            $stmt = $pdo->prepare("SELECT * FROM productos");
            $stmt->execute([]);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo $e->getMessage();
            $pdo->rollBack();
            return null;
        }
    }

    function save(): bool
    {
        $pdo = createConnection();
        try {
            $pdo->beginTransaction();
            $stmt = $pdo->prepare("SELECT * FROM productos WHERE id = ?");
            $stmt->execute([$this->id]);
            $product=$stmt->fetch(PDO::FETCH_ASSOC);
            $pdo->commit();
            $pdo->beginTransaction();
            if ($product["id"] === $this->id) {
                $stmt = $pdo->prepare("UPDATE productos SET nombre=?,precio = ?,stock=?,categoria_id=?,activo=? WHERE id = ?");
                $stmt->execute([$this->nombre, $this->precio, $this->stock, $this->categoriaId, $this->activo, $this->id]);
            }else {
                $stmt = $pdo->prepare("INSERT INTO productos(nombre,precio,stock,categoria_id,activo)VALUES (?,?,?,?,?)");
                $stmt->execute([$this->nombre, $this->precio, $this->stock, $this->categoriaId, $this->activo]);
            }
            $pdo->commit();
            return true;
        } catch (PDOException $e) {
            echo $e->getMessage();
            $pdo->rollBack();
            return false;
        }
    }

}
```

---

# EJERCICIO 2: Clase abstracta, herencia y consultas (15 puntos)

Crea la siguiente jerarquía de clases:

### 2.1 Clase abstracta `Usuario` (5 puntos)
- Propiedades: `id`, `nombre`, `email`
- Método abstracto: `getTipo(): string`
- Método concreto: `getInfo(): string` que devuelve "[$tipo] $nombre - $email"
- Método abstracto: `guardar(): bool` - Para guardar en BD

### 2.2 Clase `Cliente` que extiende `Usuario` (5 puntos)
- Propiedad adicional: `fechaRegistro` (DateTime)
- Implementa `getTipo()` devolviendo "Cliente"
- Método: `diasRegistrado(): int` - Días desde el registro hasta hoy
- Implementa `guardar()`: INSERT o UPDATE en tabla `clientes` usando PDO
- Método estático: `findById(int $id): ?Cliente` - Busca cliente por ID

### 2.3 Clase `Administrador` que extiende `Usuario` (5 puntos)
- Propiedad adicional: `nivel` (int, del 1 al 5)
- Implementa `getTipo()` devolviendo "Admin Nivel X"
- Método: `tienePermiso(int $nivelRequerido): bool` - True si su nivel >= requerido
- Implementa `guardar()`: (puede simular guardado o lanzar excepción si no existe tabla)

### Tu código:
```php
<?php
abstract class Usuario {
    public $id;
    public $nombre;
    public $email;

    /**
     * @param $id
     * @param $nombre
     * @param $email
     */
    public function __construct($id, $nombre, $email)
    {
        $this->id = $id;
        $this->nombre = $nombre;
        $this->email = $email;
    }

    abstract function getTipo():string;
     function getInfo():string{
        return $this->getTipo()."$this->nombre - $this->email";
    }
    abstract function guardar():bool;
}




// Clase Cliente:

include_once "./Usuario.php";
class Cliente extends Usuario
{

    public DateTime $fechaReguistro;

    /**
     * @param DateTime $fechaReguistro
     */
    public function __construct(DateTime $fechaReguistro,$id ,$nombre, $email)
    {
        $this->fechaReguistro = $fechaReguistro;
        parent::__construct($id, $nombre, $email);
    }

    function getTipo(): string
    {
        return "Cliente";
    }
    function diasRegistrados():int{
        return $this->fechaReguistro->diff(new DateTime())->days;
    }
    function guardar(): bool
    {
        $pdo = createConnection();
        try {
            $pdo->beginTransaction();
            $stmt = $pdo->prepare("SELECT * FROM clientes WHERE id = ?");
            $stmt->execute([$this->id]);
            $product=$stmt->fetch(PDO::FETCH_ASSOC);
            $pdo->commit();
            $pdo->beginTransaction();
            if ($product["id"] === $this->id) {
                $stmt = $pdo->prepare("UPDATE clientes SET nombre=?,email=?,fecha_registro=? WHERE id = ?");
                $stmt->execute([$this->nombre,$this->email,$this->fechaReguistro, $this->id]);
            }else {
                $stmt = $pdo->prepare("INSERT INTO clientes(nombre,email,fecha_registro)VALUES (?,?,?)");
                $stmt->execute([$this->nombre,$this->email,$this->fechaReguistro]);
            }
            $pdo->commit();
            return true;
        } catch (PDOException $e) {
            echo $e->getMessage();
            $pdo->rollBack();
            return false;
        }
    }
    static function findById(int $id): ?Cliente
    {
        $pdo = createConnection();
        try {
            $pdo->beginTransaction();
            $stmt = $pdo->prepare("SELECT * FROM clientes WHERE id = ?");
            $stmt->execute([$id]);
            $cliente = $stmt->fetch(PDO::FETCH_ASSOC);
            return new Cliente($cliente["fecha_registro"],$cliente["id"], $cliente["nombre"], $cliente["email"]);

        } catch (PDOException $e) {
            echo $e->getMessage();
            $pdo->rollBack();
            return null;
        }
    }
}




// Clase Administrador:



<?php
include_once "./conexsion.php";
class Administrador extends Usuario
{
    public $nivel;

    /**
     * @param $nivel
     */
    public function __construct($nivel,$id, $nombre, $email)
    {
        $this->nivel = $nivel;
        parent::__construct($id, $nombre, $email);
    }

    function getTipo(): string
    {
        return "Admin Nivel".$this->nivel;
    }
    function tienePermiso(int $nivelRequerido): bool
    {
        return $this->nivel >= $nivelRequerido;
    }
    function guardar(): bool
    {
        $pdo = createConnection();
        try {
            $pdo->beginTransaction();
            $stmt = $pdo->prepare("SELECT * FROM Administrador WHERE id = ?");
            $stmt->execute([$this->id]);
            $product=$stmt->fetch(PDO::FETCH_ASSOC);
            $pdo->commit();
            $pdo->beginTransaction();
            if ($product["id"] === $this->id) {
                $stmt = $pdo->prepare("UPDATE clientes SET nombre=?,email=?,nivel=? WHERE id = ?");
                $stmt->execute([$this->nombre,$this->email,$this->nivel, $this->id]);
            }else {
                $stmt = $pdo->prepare("INSERT INTO clientes(nombre,email,nivel)VALUES (?,?,?)");
                $stmt->execute([$this->nombre,$this->email,$this->nivel]);
            }
            $pdo->commit();
            return true;
        } catch (PDOException $e) {
            echo $e->getMessage();
            $pdo->rollBack();
            return false;
        }
    }
}


```

---

# EJERCICIO 3: Carrito de Compras con Interface y Transacciones (10 puntos)

Implementa un sistema de carrito de compras:

### 3.1 Interface `Carrito` (3 puntos)
Define los métodos:
- `agregarProducto(Producto $producto, int $cantidad): void`
- `eliminarProducto(int $productoId): void`
- `getTotal(): float`
- `getItems(): array`
- `vaciar(): void`

### 3.2 Clase `CarritoCompras` que implementa `Carrito` (7 puntos)

Requisitos:
- Almacena los items como array asociativo: `[productoId => ['producto' => Producto, 'cantidad' => int]]`
- `agregarProducto()`: Si el producto ya existe, suma la cantidad. Debe verificar stock con consulta SQL.
- `getTotal()`: Suma precio × cantidad de todos los items
- Método adicional: `procesarCompra(int $clienteId): int` que:
  1. Usa una **transacción** (`beginTransaction`, `commit`, `rollBack`)
  2. Inserta el pedido en la tabla `pedidos` (INSERT simple)
  3. Recorre los items con `foreach` e inserta cada uno en `detalles_pedido`
  4. Recorre los items con `foreach` y actualiza el stock de cada producto (UPDATE simple)
  5. Devuelve el ID del pedido creado (`lastInsertId()`)
  6. Si algo falla, hace rollback y lanza excepción
  
  > ⚠️ **NOTA:** Usa INSERT y UPDATE simples. El bucle foreach de PHP recorre los items.

### Tu código:
```php
<?php
require_once 'conexion.php';

// Interface Carrito:




// Clase CarritoCompras:




```

---

# EJERCICIO 4: Reportes con Trait y consultas avanzadas (5 puntos)

### 4.1 Trait `Logeable` (2 puntos)
Crea un trait con:
- Propiedad: `array $logs = []`
- Método: `log(string $mensaje): void` - Añade "[fecha] $mensaje" al array
- Método: `getLogs(): array` - Devuelve todos los logs

### 4.2 Clase `ReporteVentas` que usa el trait (3 puntos)

Requisitos:
- Usa el trait `Logeable`
- Método `productosTopVentas(int $limite = 5): array` que:
  - Obtiene todos los productos: SELECT * FROM productos
  - Obtiene todos los detalles: SELECT * FROM detalles_pedido
  - Usa `foreach` para sumar las cantidades vendidas por producto
  - Usa `usort()` o similar para ordenar de mayor a menor
  - Devuelve los primeros $limite elementos con `array_slice()`
  - Loguea cada operación
  
- Método `ventasPorCategoria(): array` que:
  - Obtiene las categorías: SELECT * FROM categorias
  - Obtiene los productos: SELECT * FROM productos  
  - Obtiene los detalles: SELECT * FROM detalles_pedido
  - Usa `foreach` para agrupar por categoría y sumar ingresos con PHP
  - Devuelve array con nombre de categoría e ingresos totales
  
> ⚠️ **NOTA:** Usa SELECT * simples. La agrupación y cálculos se hacen con PHP.

### Tu código:
```php
<?php
require_once 'conexion.php';

// Trait Logeable:




// Clase ReporteVentas:




```

---

# EJERCICIO BONUS (+5 puntos extra)

Crea una clase `GestorInventario` que:

1. Método `productosAgotados(): array` - SELECT * FROM productos, filtra con PHP los que tienen stock = 0
2. Método `productosBajoStock(int $minimo = 10): array` - SELECT * FROM productos, filtra con PHP los que tienen stock < mínimo
3. Método `reponerStock(int $productoId, int $cantidad): bool` - UPDATE simple del stock
4. Método `desactivarProducto(int $productoId): bool` - UPDATE simple: activo = false
5. Método `actualizarPrecios(int $categoriaId, float $porcentaje): int`:
   - Obtiene productos: SELECT * FROM productos WHERE categoria_id = ?
   - Recorre con foreach y actualiza cada precio con UPDATE simple
   - Devuelve el número de productos actualizados

> ⚠️ **NOTA:** Usa consultas SQL simples (SELECT *, UPDATE básico). La lógica de filtrado y cálculos se hace con PHP.

**Todas las operaciones deben usar PDO con prepared statements.**

### Tu código:
```php
<?php
require_once 'conexion.php';

// Escribe tu código bonus aquí:




```

---

# 📊 CRITERIOS DE EVALUACIÓN

| Ejercicio | Puntos | Criterios |
|-----------|--------|-----------|
| **Ejercicio 0** | 5 | Conexión PDO correcta (3), Manejo de errores (1), Charset configurado (1) |
| **Ejercicio 1** | 15 | Property Hooks correctos (4), Constructor y métodos instancia (4), Métodos estáticos con SQL simple (5), Prepared statements (2) |
| **Ejercicio 2** | 15 | Clase abstracta correcta (5), Cliente con findById y guardar (5), Admin completo (5) |
| **Ejercicio 3** | 10 | Interface definida (3), Implementación con transacción (5), Manejo de errores (2) |
| **Ejercicio 4** | 5 | Trait correcto (2), SQL simple + lógica PHP con foreach (3) |
| **BONUS** | +5 | Implementación correcta y funcional de GestorInventario |
| **TOTAL** | **50 (+5)** | |

---

## 📊 PUNTUACIÓN FINAL

| Parte | Puntos Máximos | Puntos Obtenidos |
|-------|----------------|------------------|
| **Teoría** (sin apuntes) | 50 | |
| **Práctica** (con apuntes) | 50 | |
| **Bonus** | +5 | |
| **TOTAL EXAMEN** | **100 (+5)** | |

---

### Conversión a Nota (sobre 10):
| Puntuación | Nota | Calificación |
|------------|------|--------------|
| 0-49 | 0-4.9 | Suspenso |
| 50-59 | 5-5.9 | Suficiente |
| 60-69 | 6-6.9 | Bien |
| 70-89 | 7-8.9 | Notable |
| 90-100 | 9-10 | Sobresaliente |
| 100+ | 10 (+ bonus) | Sobresaliente |

---

> 💡 **Consejo:** Comienza por los ejercicios que te resulten más fáciles. Asegúrate de que tu código compila antes de continuar.
