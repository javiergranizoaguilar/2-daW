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
        "path" => 2,
        "categorie" => "p", // Pan
        "name" => "Pan de Centeno",
        "price" => 4.50,
        "allergens" => [
            "Gluten",
            "Sésamo",
        ]
    ],
    [
        "path" => 3,
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
        "path" => 5,
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
        "path" => 6,
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
        "path" => 8,
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
        "path" => 9,
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
    return implode(",", $array);
}
foreach (INFORMATION_BREAD as $pan) {
    echo ('<article class="product-card salados">
                <img src='.$pan['path'].' alt='.$pan['name'].'>
                <h3>'.$pan['name'].'</h3>
                <p class="price">Desde '.$pan['price'].'€ (por porción)</p>
                <div class="allergen-tag">'.alegenstoString($pan['allergens']).'</div>
                <a href="" class="detail-link">Añadir al Carrito</a>
            </article>');
}
?>