<?php

const INFORMATION_BREAD = [
    [
        "path" => "../imgs/panes/hogaza.webp",
        "categorie" => "p", // Pan
        "name" => "Hogaza",
        "price" => 4.50,
        "allergens" => [
            "Gluten",
        ]
    ],
    [
        "path" => "../imgs/panes/centeno.png",
        "categorie" => "p", // Pan
        "name" => "Pan de Centeno",
        "price" => 4.50,
        "allergens" => [
            "Gluten",
            "Sésamo",
        ]
    ],
    [
        "path" => "../imgs/panes/integral.png",
        "categorie" => "p", // Pan
        "name" => "Pan Integral de Espelta",
        "price" => 3.90,
        "allergens" => [
            "Gluten",
        ]
    ],
    // --- Bollería Dulce ---
    [
        "path" => "../imgs/panes/croisan.webp",
        "categorie" => "d", // Dulce
        "name" => "Croissant de Mantequilla",
        "price" => 1.80,
        "allergens" => [
            "Gluten",
            "Lácteos",
            "Huevo",
        ]
    ],
    [
        "path" => "../imgs/panes/apple_pie.webp",
        "categorie" => "d", // Dulce
        "name" => "Tarta de Manzana",
        "price" => 4.20,
        "allergens" => [
            "Gluten",
            "Lácteos",
            "Huevo",
            "Frutos de cáscara",
        ]
    ],
    [
        "path" => "../imgs/panes/muffin.png",
        "categorie" => "d", // Dulce
        "name" => "Muffin de Chocolate",
        "price" => 2.50,
        "allergens" => [
            "Gluten",
            "Lácteos",
            "Huevo",
        ]
    ],
    // --- Productos Salados ---
    [
        "path" => "../imgs/panes/empanada.webp",
        "categorie" => "s", // Salado
        "name" => "Empanada de Atún",
        "price" => 5.50,
        "allergens" => [
            "Gluten",
            "Huevo",
            "Pescado",
        ]
    ],
    [
        "path" => "../imgs/panes/quiche.webp",
        "categorie" => "s", // Salado
        "name" => "Quiche de Verduras",
        "price" => 3.50,
        "allergens" => [
            "Gluten",
            "Lácteos",
            "Huevo",
        ]
    ],
    [
        "path" => "../imgs/panes/iberico.webp",
        "categorie" => "s", // Salado
        "name" => "Bocadillo de Jamón y Queso",
        "price" => 4.90,
        "allergens" => [
            "Gluten",
            "Lácteos",
        ]
    ],
];
function alegenstoString($array):String
{
    return implode(", ", $array);
}
function listarPanes(array $panes, $tipe): array {
    // Usando una función anónima tradicional con 'use'
    return array_filter($panes, function (array $pan) use ($tipe) {
        return $tipe=="all"?true:$pan['categorie'] == $tipe;
    });
}
$tipe = $_GET['tipe'] ?? 'all';
foreach (listarPanes(INFORMATION_BREAD,$tipe) as $pan) {

    echo ('<article>
                <div class="product-image-container">
                    <img src="'.$pan['path'].'" alt="'.$pan['name'].'" class="product-image">
                </div>
                <div class="product-info">
                    <h3 class="product-name">'.$pan['name'].'</h3>
                    <p class="product-price">€'.$pan['price'].'</p>
                    <div class="product-allergens">Alérgenos: '.alegenstoString($pan['allergens']).'</div>
                    <a href="" class="product-detail-link">Añadir al Carrito</a>
                </div>
            </article>');
}
?>
