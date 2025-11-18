'use strict'

// Función para mostrar alerta al hacer clic en el botón
function mostrarHola() {
    alert("hola");
}

// Función para mostrar alerta al pasar el ratón sobre la imagen
function mostrarAdios() {
    alert("adios");
}
function pedirNombre() {
    let name = prompt("¿Cuál es tu nombre?");
    alert("Bienvenid@ a mi página " + name);
}

function realizarCompra() {
    let nameproduct = prompt("¿Cuál es el nombre del producto?");
    let price = prompt("¿Cuál  su pecio?");
    let amount = prompt("¿Cuál es la cantidad?");

    let total = price * amount;

    console.log("Producto: " + nameproduct + ", Cantidad: " + amount + ", Total: " + total);

    let yes = confirm("¿Desea confirmar la compra?");
    if (yes) { yes = "Comfirmado"; } else { yes = "Denegado" }
    alert("Has " + yes + " la compra de " + amount + " " + nameproduct + " por un total de " + total);
}
//Extra opr los loles
function cambiarImagen() {
    var miImagen = document.getElementById("meme");
    // Puedes usar una lógica para alternar entre varias imágenes
    if (miImagen.src.endsWith("images.jpeg")) {
        miImagen.src = "images2.jpeg"; // Cambia a la segunda imagen
        miImagen.alt = "Imagen 2"; // Actualiza el texto alternativo también
    } else {
        miImagen.src = "images.jpeg";
        miImagen.alt = "Imagen 1";
    }
}
function rgb() {
    var text1 = document.getElementById("text1");

    text1.style.color = "rgb(" + Math.floor(Math.random() * 256) + "," + Math.floor(Math.random() * 256) + "," + Math.floor(Math.random() * 256) + ")";

}