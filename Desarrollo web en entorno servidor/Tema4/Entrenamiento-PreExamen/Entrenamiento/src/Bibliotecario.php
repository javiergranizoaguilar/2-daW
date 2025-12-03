<?php

class Bibliotecario extends Persona
{
    public string $seccion;

    public function getRol(): string
    {
        return "Bibliotecario - $this->seccion";
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
                    INSERT INTO bibliotecarios (nombre, email,seccion)
                    VALUES (?, ?, ?)
                ");
                $stmt->execute([$this->nombre,$this->email,$this->seccion]);
                $pdo->commit();
            }
            else{
                $pdo->beginTransaction();
                $stmt = $pdo->prepare("
                UPDATE bibliotecarios 
                SET nombre = ?,email = ?,seccion = ?
                WHERE id = ?");
                $stmt->execute([$this->nombre,$this->email,$this->seccion,$this->id]);
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