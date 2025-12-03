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
include_once "./src/conexion.php";
class Libro
{
    public pdo $pdo;
    private(set) public int $id;
    public string $titulo {
        get {
            return trim($this->titulo);
        }
        set {
            $this->titulo = $value;
        }
    }
    public int $autorId;
    public int $generoId;
    public string $isbn;
    public int $ejemplares {
        set {
            if ($value < 0) {
                throw new Exception("El ejemplares no pueden ser negativos");
            }
            $this->ejemplares = $value;
        }
    }
    public int $disponibles {
        set {
            if ($value < 0 && $value > $this->ejemplares) {
                throw new Exception("El disponibles no pueden ser iguales");
            }
            $this->disponibles = $value;
        }
    }

    /**
     * @param int $id
     * @param string $titulo
     * @param int $autorId
     * @param int $generoId
     * @param string $isbn
     * @param int $ejemplares
     * @param int $disponibles
     */
    public function __construct(int $id, string $titulo, int $autorId, int $generoId, string $isbn, int $ejemplares, int $disponibles)
    {
        $this->id = $id;
        $this->titulo = $titulo;
        $this->autorId = $autorId;
        $this->generoId = $generoId;
        $this->isbn = $isbn;
        $this->ejemplares = $ejemplares;
        $this->disponibles = $disponibles;
        $this->pdo=createConnection();
    }

    public function estaDisponible(): bool
    {
        return $this->disponibles > 0;
    }
    public function prestar(): bool
    {
        if ($this->estaDisponible()) {
            $this->disponibles--;
            return true;
        }
        return false;
    }
    public function devolver(): bool
    {
        if ($this->disponibles<=$this->ejemplares) {
            $this->disponibles++;
            return true;
        }
        return false;
    }
    public function toAray(): array{
        $array[]=[
            "id"=>$this->id,
            "titulo"=>$this->titulo,
            "autorId"=>$this->autorId,
            "generoId"=>$this->generoId,
            "isbn"=>$this->isbn,
            "ejemplares"=>$this->ejemplares,
            "disponibles"=>$this->disponibles
        ];
        return $array;
    }
    public static function buscarPorId(int $id): ?Libro
    {
        $pdo=createConnection();
        try {
            $pdo->beginTransaction();
            $stmt1=$pdo->prepare("SELECT * FROM libros WHERE id=?");
            $stmt1->execute([$id]);
            $stmt=$stmt1->fetch(PDO::FETCH_ASSOC);
            $pdo->commit();
            return new Libro($id,$stmt["titulo"],$stmt["autor_id"],$stmt["genero_id"],$stmt["isbn"],$stmt["ejemplares"],$stmt["disponibles"]);
        }
        catch (PDOException $e) {
            $pdo->rollBack();
            echo $e->getMessage();
            return null;
        }
    }
    public static function buscarTodos(): array
    {
        $pdo=createConnection();
        try {
            $pdo->beginTransaction();
            $stmt1=$pdo->prepare("SELECT * FROM libros");
            $stmt1->execute([]);
            $stmt=$stmt1->fetchall(PDO::FETCH_ASSOC);
            $pdo->commit();
            return $stmt;
        }
        catch (PDOException $e) {
            $pdo->rollBack();
            echo $e->getMessage();
            return [];
        }
    }
}
?>

```
