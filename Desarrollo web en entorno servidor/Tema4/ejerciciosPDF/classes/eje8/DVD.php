<?php
include_once "Material.php";
include_once "Prestable.php";
include_once __DIR__.'/Valorable.php';
class DVD extends Material implements Prestable
{
    use Valorable;
    private $prestable = true;
    public $protagonista {
        get {
            return $this->protagonista;
        }
        set {
            $this->protagonista = $value;
        }
    }

    /**
     * @param $protagonista
     */
    public function __construct($protagonista,$titulo, $autor)
    {
        $this->protagonista = $protagonista;
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
            echo "No hay DVD";
        }
    }

    public function devolver()
    {
        if (!$this->prestable) {
            $this->prestable = true;
        }
        else{
            echo "No tienes el DVD";
        }
    }
}