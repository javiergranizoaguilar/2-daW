<?php
include_once "./src/conexion.php";
include_once "./src/Libro.php";
$pdo=createConnection();
print"\n";
var_dump(buscarPorId(1)->toAray());
print"\n";
var_dump(buscarTodos());

function buscarPorId(int $id): ?Libro
{
    global $pdo;
    try {
        $pdo->beginTransaction();
        $stmt1=$pdo->prepare("SELECT * FROM libros WHERE id=?");
        $stmt1->execute([$id]);
        $stmt=$stmt1->fetch(PDO::FETCH_ASSOC);
        $pdo->commit();
        return new Libro($id,$stmt["titulo"],$stmt["autor_id"],$stmt["genero_id"],$stmt["isbn"],$stmt["ejemplares"],$stmt["disponibles"]);
    }
    catch (PDOException $e) {
        $pdo->rollBack();
        echo $e->getMessage();
        return null;
    }
}function buscarTodos():array
{
    global $pdo;
    try {
        $pdo->beginTransaction();
        $stmt1=$pdo->prepare("SELECT * FROM libros");
        $stmt1->execute();
        $stmt=$stmt1->fetchAll(PDO::FETCH_ASSOC);
        $pdo->commit();
        return $stmt;
    }
    catch (PDOException $e) {
        $pdo->rollBack();
        echo $e->getMessage();
        return [];
    }
}