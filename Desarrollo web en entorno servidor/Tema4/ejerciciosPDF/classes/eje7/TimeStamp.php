<?php

trait TimeStamp
{
    public $fechaCreacion;
    public $fechaModificacion;

    /**
     * @return mixed
     */
    public function getFechaCreacion()
    {
        return $this->fechaCreacion;
    }

    /**
     * @param mixed $fechaCreacion
     */
    public function setFechaCreacion(): void
    {
        $this->fechaCreacion = date("Y/m/d");
    }

    /**
     * @return mixed
     */
    public function getFechaModificacion()
    {
        return $this->fechaModificacion;
    }

    /**
     * @param mixed $fechaModificacion
     */
    public function setFechaModificacion(): void
    {
        $this->fechaModificacion =date("Y/m/d");
    }
}