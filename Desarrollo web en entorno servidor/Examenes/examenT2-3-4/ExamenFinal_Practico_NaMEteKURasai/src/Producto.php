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