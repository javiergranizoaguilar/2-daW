<?php

class SocioPremium extends Socio
{
    public int $limiteLibros{
        set(int $value) {
            if ($value >10||$value<0) {
                throw new Exception("Limite entre 10 y 0");
            }
            $this->limiteLibros=$value;
        }
    }
    public function getRol():string
    {
        return "Socio Premium";
    }
    public function puedePrestar(int $librosActuales):bool
    {
        return $librosActuales<$this->limiteLibros;
    }

}