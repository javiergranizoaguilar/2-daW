<?php

class CuentaBancaria
{
    private $saldo;

    public function __construct($saldo)
    {
        $this->saldo = $saldo;
    }

    public function consultarSaldo()
    {
        return $this->saldo;
    }

    public function retirar($retirar): void
    {
        $this->saldo -= $retirar;
    }

    public function depositar($depositar): void
    {
        $this->saldo += $depositar;
    }
}