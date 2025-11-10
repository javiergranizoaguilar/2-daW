'use strict'

function Eje2() {
    let num = pedirNumero();;
    

    switch (true) {
        case num <= 10:
            document.writeln("<h1>Corredor Novato<h1>");
            break;
        case num > 10 && num <= 30:
            document.writeln("<h1>Corredor Iniciado<h1>");
            break;
        case num > 30 && num <= 40:
            document.writeln("<h1>Corredor Experto<h1>");
            break;
        case num > 40:
            document.writeln("<h1>Corredor Nievel Elite<h1>");
            break;
        default: document.writeln("<h1>Tu eres un hacker</h1>")
    }
    function pedirNumero() {
        let numero;
        do {
            numero = prompt("Introduce un número mallor a 0:");

            // Convertimos a número y validamos
            numero = parseFloat(numero);

            // Verificamos si:
            // - No es un número válido (isNaN)
            if (isNaN(numero) || numero <= 0) {
                alert("Por favor, introduce un número mallor a 0");
                numero = null; // Forzamos a que siga en el bucle
            }
        } while (numero === null || isNaN(numero) || numero <= 0);

        return numero;
    }
}