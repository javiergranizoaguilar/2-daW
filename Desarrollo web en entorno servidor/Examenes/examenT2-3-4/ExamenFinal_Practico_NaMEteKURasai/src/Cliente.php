<?php
include_once "./Usuario.php";
include_once "./conexsion.php";
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