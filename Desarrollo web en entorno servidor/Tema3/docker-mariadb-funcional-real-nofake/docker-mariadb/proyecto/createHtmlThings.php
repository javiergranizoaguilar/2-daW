<?php

function createTableArrayMultiple($array){
    foreach ($array as $row){
        createTableArrayUnitary($row);
    }
}
function createTableArrayUnitary($arrayObjects)
{

    if (!is_array($arrayObjects) || empty($arrayObjects)) {
        echo "<p class='info'>No hay resultados para mostrar en la tabla.</p>";
    } else {
        $arraykeys = array_keys($arrayObjects[0]);

        echo "<table style='width: 100%; border-collapse: collapse;'>";
        echo "<tr style='background: #f4f4f4;'>";
        foreach ($arraykeys as $key) {
            echo "<th style='padding: 10px; border: 1px solid #ddd;'>$key</th>";
        }
        echo "</tr>";
        foreach ($arrayObjects as $object) {
            echo "<tr>";
            foreach ($arraykeys as $key) {
                echo "<td style='padding: 10px; border: 1px solid #ddd;'>{$object[$key]}</td>";
            }
            echo "</tr>";
        }
        echo "</table>";
    }
}

function createEstatement($title, $texts, $hint)
{
    echo "<h1>{$title}</h1>";
    $n = count($texts);
    for ($x = 0; $x < $n; $x++) {

        echo $x == 0 ? "<h1 class='exercise'>$texts[$x]</h1>" : "<h1 class='points'>$texts[$x]</h1>";
    }
    echo "<h1>{$hint}</h1>";
}

function createEjer()
{
    $n = count(ESTATEMENTS);
    for ($x = 1; $x < $n; $x++) {

        createEstatement(ESTATEMENTS[$x - 1]['title'], ESTATEMENTS[$x - 1]['texts'], ESTATEMENTS[$x - 1]['hint']);

        $functionName = 'eje' . $x;

        if (function_exists($functionName)) {
            $functionName();
        } else {
            echo "Advertencia: La función $functionName no está definida.\n";
        }
    }
}

?>