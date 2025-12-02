<?php
class Libro
{
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
        get {
            return $this->ejemplares;
        }
        set {
            if ($value < 0) {
                throw new Exception("El ejemplares no pueden ser negativos");
            }
            $this->ejemplares = $value;
        }
    }
    public int $disponibles {
        get {
            return $this->disponibles;
        }
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

}