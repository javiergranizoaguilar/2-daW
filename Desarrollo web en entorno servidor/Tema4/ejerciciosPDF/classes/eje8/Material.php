<?php

abstract class Material
{
    public string $titulo {
        get {
            return $this->titulo;
        }
        set {
            $this->titulo = $value;
        }
    }
    public string $autor {
        get {
            return $this->autor;
        }
        set {
            $this->autor = $value;
        }
    }

    /**
     * @param string $titulo
     * @param string $autor
     */
    public function __construct(string $titulo, string $autor)
    {
        $this->titulo = $titulo;
        $this->autor = $autor;
    }

}