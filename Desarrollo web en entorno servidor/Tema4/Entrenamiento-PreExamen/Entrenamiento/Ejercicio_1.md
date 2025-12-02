# 📝 EJERCICIO 1: Conexión y Clase Libro (20 min)

## Parte A: Conexión PDO

Crea un archivo `conexion.php` con una función `conectar()` que:
- Devuelva un objeto PDO conectado a la base de datos `biblioteca`
- Configure el modo de errores como excepciones
- Use charset `utf8mb4`
- Maneje errores con try-catch

**Credenciales:**
- Host: `localhost`
- Puerto: `3307`
- BD: `biblioteca`
- Usuario: `estudiante`
- Password: `estudiante123`

---

## Parte B: Clase Libro

Crea la clase `Libro` con:

### Propiedades (usa Property Hooks donde tenga sentido):
- `id`: int (solo lectura)
- `titulo`: string (sin espacios al inicio/final)
- `autorId`: int
- `generoId`: int
- `isbn`: string
- `ejemplares`: int (mínimo 0)
- `disponibles`: int (mínimo 0, máximo = ejemplares)

### Métodos:
- `estaDisponible(): bool` - True si disponibles > 0
- `prestar(): bool` - Reduce disponibles en 1 si hay stock
- `devolver(): bool` - Aumenta disponibles en 1 (sin pasar de ejemplares)
- `toArray(): array` - Devuelve array asociativo con todas las propiedades

### Métodos estáticos:
- `buscarPorId(int $id): ?Libro` - Busca un libro por ID en la BD
- `buscarTodos(): array` - Devuelve todos los libros como objetos Libro

---

## Tu código:

```php
<?php
// conexion.php
$host = '127.0.0.1';
$port = '3307';
$dbname = 'biblioteca';
$username = 'estudiante';
$password = 'estudiante123';
$pdo = createConnection();
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
?>


// Libro.php

<?php 

?>


```
