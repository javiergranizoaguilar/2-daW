<?php

interface Prestable {
    public function registrarPrestamo(int $socioId, int $libroId): int;
    public function registrarDevolucion(int $prestamoId): bool;
    public function getPrestamosActivos(int $socioId): array;
    public function getHistorial(int $socioId): array;
}