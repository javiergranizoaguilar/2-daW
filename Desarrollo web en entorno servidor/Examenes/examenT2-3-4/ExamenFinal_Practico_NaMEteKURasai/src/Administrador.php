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