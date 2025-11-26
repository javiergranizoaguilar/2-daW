<?php
include_once "Material.php";
include_once "Prestable.php";
include_once __DIR__.'/Valorable.php';
class Revista extends Material implements Prestable
{
    use Valorable;
    private $prestable = true;
    public $empresa {
        get {
            return $this->empresa;
        }
        set {
            $this->empresa = $value;
        }
    }

    /**
     * @param $empresa
     */
    public function __construct($empresa, $titulo, $autor)
    {
        $this->empresa = $empresa;
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
            echo "No hay Revisar";
        }
    }

    public function devolver()
    {
        if (!$this->prestable) {
            $this->prestable = true;
        }
        else{
            echo "No tienes el Revisar";
        }
    }
}