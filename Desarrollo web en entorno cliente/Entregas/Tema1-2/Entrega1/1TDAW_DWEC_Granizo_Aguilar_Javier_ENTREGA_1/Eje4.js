'use strict'
function Eje41() {
    //a
    let colors = ['red', 'yellow', 'green', 'white', 'blue', 'brown', 'pink', 'black'];
    let numero;
    let colorsUsa = [];

    numero = pedirNumero();

    for (let x = 0; x < 5; x++) {
        colorsUsa.push(colors[Math.floor(Math.random() * colors.length)]);
    }
    let table = "<table border='1' style='border-collapse: collapse; width: 100%;'><tr>";

    for (let i = 0; i < numero; i++) {
        table += `<td style='background-color: ${colorsUsa[i]}; height: 300px; width: ${100 / numero}%;'></td>`;
    }
    table += "</tr> </table>";
    document.writeln(table);
}
function Eje42() {
    //b
    let colors = ['red', 'yellow', 'green', 'white', 'blue', 'brown', 'pink', 'black'];
    let numero;
    let colorsUsa = [];
    numero = pedirNumero();
    for (let x = 0; x < 5; x++) {
        colorsUsa.push(colors[Math.floor(Math.random() * colors.length)]);
        for (let y = 0; y < colorsUsa.length; y++) {
            if (colorsUsa[y] == colorsUsa[x] && y != x) {
                do {
                    colorsUsa[x] = (colors[Math.floor(Math.random() * colors.length)]);
                } while (colorsUsa[y] == colorsUsa[x])
            }
        }
    }

    let table = "<table border='1' style='border-collapse: collapse; width: 100%;'><tr>";

    for (let i = 0; i < numero; i++) {
        table += `<td style='background-color: ${colorsUsa[i]}; height: 300px; width: ${100 / numero}%;'></td>`;
    }
    table += "</tr> </table>";
    document.writeln(table);
}
function Eje43() {
    //c
    let colors = ['red', 'yellow', 'green', 'white', 'blue', 'brown', 'pink', 'black'];
    let numero;
    let colorsUsa = [];
    numero=pedirNumero();
    for (let x = 0; x < 5; x++) {
        colorsUsa.push(colors[Math.floor(Math.random() * colors.length)]);
        if (colorsUsa[x - 1] == colorsUsa[x] && x != 0) {
            do {
                colorsUsa[x] = (colors[Math.floor(Math.random() * colors.length)]);
            } while (colorsUsa[x - 1] == colorsUsa[x]);
        }
    }
    let table = "<table border='1' style='border-collapse: collapse; width: 100%;'><tr>";

    for (let i = 0; i < numero; i++) {
        table += `<td style='background-color: ${colorsUsa[i]}; height: 300px; width: ${100 / numero}%;'></td>`;
    }
    table += "</tr> </table>";
    document.writeln(table);
}
function pedirNumero() {
    let numero;
    do {
        numero = prompt("Introduce un número mallor a 0:");

        // Convertimos a número y validamos
        numero = parseFloat(numero);

        // Verificamos si:
        // - No es un número válido (isNaN)
        // - No es un número entero (numero % 1 !== 0)
        // - Está fuera del rango 1-5
        if (isNaN(numero) || numero < 1 || numero > 5) {
            alert("Por favor, introduce un número entre 1 y 5 incluidos");
            numero = null; // Forzamos a que siga en el bucle
        }
    } while (numero === null || isNaN(numero) || numero < 1 || numero > 5);

    return numero;
}