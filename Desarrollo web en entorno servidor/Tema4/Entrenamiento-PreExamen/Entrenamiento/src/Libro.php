<?php

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