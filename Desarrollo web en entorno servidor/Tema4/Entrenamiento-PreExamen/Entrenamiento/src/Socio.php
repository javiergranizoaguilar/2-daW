<?php
include_once "./src/Persona.php";
class Socio extends Persona
{

    public DateTime $fechaAlta;
    public bool $activo;

    /**
     * @param bool $activo
     * @param DateTime $fechaAlta
     */
    public function __construct(bool $activo, DateTime $fechaAlta,int $id, string $nombre, string $email)
    {
        $this->activo = $activo;
        $this->fechaAlta = $fechaAlta;
        parent::__construct($id, $nombre, $email);
    }

    public function getRol():string
    {
        return "Socio";
    }
    public function antiguedad():int{
        return $this->fechaAlta->getTimestamp();
    }
    public function estaActivo():bool{
        return $this->activo;
    }
    public function darseDeBaja():void{
     $this->activo = false;
    }
    public function guardar():bool
    {
        $exsist[]=[];
        $pdo = createConnection();
        try {
            $pdo->beginTransaction();
            $stmt = $pdo->prepare("SELECT * FROM socios WHERE id = ?");
            $stmt->execute([$this->id]);
            $exsist=$stmt->fetch(PDO::FETCH_ASSOC);
            $pdo->commit();
            if (!$exsist) {
                $pdo->beginTransaction();
                $stmt = $pdo->prepare("
                    INSERT INTO socios (nombre, email, fecha_alta, activo)
                    VALUES (?, ?, ?, ?)
                ");
                $stmt->execute([$this->nombre,$this->email,$this->fechaAlta->format('Y-m-d H:i:s'),$this->activo]);
                $pdo->commit();
            }
            else{
                $pdo->beginTransaction();
                $stmt = $pdo->prepare("
                UPDATE socios 
                SET nombre = ?,email = ?,fecha_alta= ?,activo=?
                WHERE id = ?");
                $stmt->execute([$this->nombre,$this->email,$this->fechaAlta->format('Y-m-d H:i:s'),$this->activo, $this->id]);
                $pdo->commit();
            }
        }
        catch (PDOException $e){
            $pdo->rollBack();
            echo $e->getMessage();
        }
        return $exsist;
    }
}