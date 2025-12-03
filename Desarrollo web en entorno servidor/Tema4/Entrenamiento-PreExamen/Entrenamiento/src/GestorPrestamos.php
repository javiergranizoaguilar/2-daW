<?php
include_once "./Prestable.php";
include_once "./conexion.php";
class GestorPrestamos implements Prestable
{
    public function registrarPrestamo(int $socioId, int $libroId): int
    {
        $prestamoId[]=[];
        $pdo = createConnection();
        try {
            $pdo->beginTransaction();
            $stmt = $pdo->prepare("SELECT * FROM libros WHERE id=?");
            $stmt->execute([$libroId]);
            $libro = $stmt->fetch();
            $pdo->commit();
        } catch (PDOException $e) {
            echo "\n".$e->getMessage()."\n";
            $pdo->rollBack();
        }
        if ($libro["disponibles"] > 0) {
            try {
                $pdo->beginTransaction();
                $stmt = $pdo->prepare("INSERT INTO prestamos(socio_id, libro_id) VALUES(?,?)");
                $stmt->execute([$socioId,$libroId]);
                $stmt = $pdo->prepare("UPDATE libros SET disponibles=disponibles-1 WHERE id=?");
                $stmt->execute([$libroId]);
                $pdo->commit();
            } catch (PDOException $e) {
                echo "\n".$e->getMessage()."\n";
                $pdo->rollBack();
            }
        }
        try {
            $pdo->beginTransaction();
            $stmt = $pdo->prepare("SELECT id FROM prestamos WHERE libro_id=?");
            $stmt->execute([$libroId]);
            $prestamoId = $stmt->fetchColumn();
            $pdo->commit();
        } catch (PDOException $e) {
            echo $e->getMessage()."\n";
            $pdo->rollBack();
        }
        return $prestamoId;
    }

    public function registrarDevolucion(int $prestamoId): bool
    {
        $verdad=false;
        $pdo = createConnection();
        try {
            $pdo->beginTransaction();
            $stmt = $pdo->prepare("Select * FROM prestamos WHERE id=?");
            $stmt->execute([$prestamoId]);
            $prestamo = $stmt->fetch();
            $pdo->commit();
        }catch (PDOException $e) {
            echo $e->getMessage();
            $pdo->rollBack();

        }
        if ($prestamo){
            try {
                $pdo->beginTransaction();
                $stmt = $pdo->prepare("UPDATE prestamos SET devuelto=? ,fecha_devolucion=? WHERE id=?");
                $stmt->execute([true,date("Y-m-d"),$prestamoId]);
                $stmt = $pdo->prepare("UPDATE libros SET disponibles=disponibles+1 WHERE id=?");
                $stmt->execute([$prestamo["libro_id"]]);
                $pdo->commit();
                $verdad= true;
            }catch (PDOException $e) {
                echo $e->getMessage();
                $pdo->rollBack();

            }
        }
        return $verdad;
    }

    public function getPrestamosActivos(int $socioId): array
    {
        $pdo=createConnection();
        try {
            $pdo->beginTransaction();
            $stmt = $pdo->prepare("SELECT * FROM prestamos WHERE socio_id = ? AND devuelto = FALSE");
            $stmt->execute([$socioId]);
            return $stmt->fetchAll();
        }catch (PDOException $e) {
            echo $e->getMessage();
            $pdo->rollBack();
            return [];
        }
    }

    public function getHistorial(int $socioId): array
    {
        $pdo=createConnection();
        try {
            $pdo->beginTransaction();
            $stmt = $pdo->prepare("SELECT * FROM prestamos WHERE socio_id = ?");
            $stmt->execute([$socioId]);
            return $stmt->fetchAll();
        }catch (PDOException $e) {
            echo $e->getMessage();
            $pdo->rollBack();
            return [];
        }
    }
}