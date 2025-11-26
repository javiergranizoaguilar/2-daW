<?php
include_once "Material.php";
include_once "Prestable.php";
include_once __DIR__.'/Valorable.php';
class Libro extends Material implements Prestable
{
    use Valorable;
    private $prestable = true;
    public $iva {
        get {
            return $this->iva;
        }
        set {
            $this->iva = $value;
        }
    }

    /**
     * @param $iva
     */
    public function __construct($iva, $titulo, $autor)
    {
        $this->iva = $iva;
        parent::__construct($titulo, $autor);
    }

    public function prestable()
    {
        return $this->prestable;
    }

    public function prestar(): void
    {
        if ($this->prestable) {
            $this->prestable = false;
        }
        else{
            echo "No hay libros";
        }
    }

    public function devolver()
    {
        if (!$this->prestable) {
            $this->prestable = true;
        }
        else{
            echo "No tienes el libro";
        }
    }

}