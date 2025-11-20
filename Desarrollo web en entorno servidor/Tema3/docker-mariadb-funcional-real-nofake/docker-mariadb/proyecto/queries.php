<?php

// Conexión a la base de datos
function createConnection()
{
    try {
        global $host, $dbname, $username, $password;
        $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        echo "<p class='success'>✅ Conexión exitosa a la base de datos</p>";
        return $pdo;
    } catch (PDOException $e) {
        echo "<p class='error'>❌ Error de conexión: " . $e->getMessage() . "</p>";
        echo "<div class='info'>";
        echo "<strong>Verifica que:</strong><br>";
        echo "- Los contenedores estén corriendo: <code>docker compose -f docker-compose-alumnos.yml ps</code><br>";
        echo "- El servicio de base de datos esté disponible<br>";
        return null;
    }

}

//hacer queries
function makeSelecQueriesMultiple($query, $values = null)
{
    global $pdo;
    $aux = [];

    $n = count($query);
    for ($x = 0; $x < $n; $x++) {

        $aux2 = makeSelecQueriesUnitari($query[$x], $values[$x]);
        $aux[$x] = $aux2;

    }
    return $aux;
}

function makeSelecQueriesUnitari($query, $values = null)
{
    return makeQueriesUnitari($query, $values)->fetchAll(PDO::FETCH_ASSOC);
}

function makeQueriesUnitariMultiple($query, $values = null)
{
    global $pdo;
    $aux = [];
    $n = count($query);
    try {
        for ($x = 0; $x < $n; $x++) {
            $aux2 = makeQueries($pdo, $query[$x], $values[$x]);
            $aux[$x] = $aux2;
        }
        $pdo->commit();
    }
    catch (PDOException $e) {
        $pdo->rollback();
        echo $e->getMessage();
    }
    return $aux;
}
function makeQueriesMultiple($query, $values = null)
{
    $aux = [];
    $n = count($query);
    for ($x = 0; $x < $n; $x++) {
        $aux2 = makeQueriesUnitari($query[$x], $values[$x]);
        $aux[$x] = $aux2;
    }
    return $aux;
}

function makeQueriesUnitari($query, $values = null)
{
    global $pdo;
    try {
        $stmt = makeQueries($pdo, $query, $values);
        $pdo->commit();
    }catch (Exception $e) {
    echo "<p class='error'>❌ Error de ejecucion: " . $e->getMessage() . "</p>";
    $pdo->rollBack();
    }
    return $stmt;

}

function makeQueries($pdo, $query, $values = null)
{
    $pdo->beginTransaction();
    $stmt = $pdo->prepare($query);
    if (is_array($values)) {
        $stmt->execute($values);
    } else {
        if ($values !== null) {
            $stmt->execute([$values]);
        } else {
            $stmt->execute();
        }
    }
    return $stmt;
}
?>