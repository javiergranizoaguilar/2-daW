'use strict'
function main() {
    let rejilla = [];

    rejilla = pedirrejilla();
    let g = pedirNumero(1);
    rejilla = regeneracion(rejilla, g);
    let vidasI = recolectarvivos(rejilla);
    console.log("Vivas: " + vidasI);
}
function sonArraysIguales(arr1, arr2) {
    if (arr1.length !== arr2.length) return false;
    for (let i = 0; i < arr1.length; i++) {
        if (arr1[i].length !== arr2[i].length) return false;
        for (let j = 0; j < arr1[i].length; j++) {
            if (arr1[i][j] !== arr2[i][j]) return false;
        }
    }
    return true;
}

function regeneracion(rejaI, g) {
    for (let x = 0; x < g; x++) {
        const nuevaGeneracion = regeneracionLogic(rejaI);

        if (!sonArraysIguales(nuevaGeneracion, rejaI)) {
            rejaI = nuevaGeneracion;
            console.log("Generación " + (x + 1));
            console.log(rejaI);
        }
        else {
            console.log("✅ ESTABILIZADO - Saliendo en generación " + (x + 1));
            break;
        }
    }
    return rejaI;
}
function recolectarvivos(rejaI) {
    let vidasI = 0;
    for (let x = 0; x < rejaI.length; x++) {
        for (let y = 0; y < rejaI.length; y++) {
            if (rejaI[x][y] === 1) {
                vidasI++;
            }
        }
    }
    return vidasI;
}
function regeneracionLogic(rejaI) {

    let aux1 = [];
    let aux2 = [];
    let x1 = 0;
    let x2 = 0;
    let y1 = 0;
    let y2 = 0;
    let vivas = 0;
    for (let x = 0; x < rejaI.length; x++) {
        aux2 = [];
        for (let y = 0; y < rejaI.length; y++) {

            switch (true) {
                case x - 1 < 0:
                    x1 = 0
                    x2 = x + 1
                    break;
                case x + 1 >= rejaI.length:
                    x1 = x - 1
                    x2 = rejaI.length - 1;
                    break;
                default:
                    x1 = x - 1
                    x2 = x + 1
                    break;
            }
            switch (true) {
                case y - 1 < 0:
                    y2 = y + 1
                    break;
                case y + 1 >= rejaI.length:
                    y2 = rejaI.length - 1;
                    break;
                default:
                    y2 = y + 1
                    break;
            }
            vivas = 0;
            for (x1; x1 <= x2; x1++) {
                for (let y1 = y - 1 < 0 ? 0 : y - 1; y1 <= y2; y1++) {

                    if (rejaI[x1][y1] != rejaI[x][y]) {
                        if (rejaI[x1][y1] === 1) {
                            vivas++;
                        }
                    }
                }
            }

            aux2.push(logico(rejaI[x][y], vivas))
        }
        aux1.push(aux2);
    }
    return aux1
}
function logico(x, v) {
    switch (true) {
        case x === 1 && v < 2:
            x = 0
            break;
        case x === 1 && v >= 2 && v <= 3:
            x = 1
            break;
        case x === 1 && v > 3:
            x = 0
            break;
        case x === 0 && v == 3:
            x = 1
            break;
        default:
            x = 0
            break;
    }
    return x;
}
function pedirrejilla() {
    let tamaniorejilla = pedirNumeroRango(3, 30);
    let vidasI = pedirNumeroRangoP(1, 99);
    let rejilla = [];
    let aux = [];
    for (let x = 0; x < tamaniorejilla; x++) {
        for (let y = 0; y < tamaniorejilla; y++) {

            if (Math.floor(Math.random() * 100) < vidasI) {
                aux.push(1);
            }
            else {
                aux.push(0);
            }
        }
        rejilla.push(aux);
        aux = [];
    }
    console.log(rejilla);
    return rejilla;

}
// Función para pedir un número dentro de un rango
function pedirNumeroRango(num1, num2) {
    let numero;
    do {
        numero = prompt("Introduce un número entre " + num1 + " y " + num2 + ":");

        // Convertimos a número y validamos
        numero = parseFloat(numero);

        // Verificamos si:
        // - No es un número válido (isNaN)
        if (isNaN(numero)) {

            numero = null; // Forzamos a que siga en el bucle
        }
    } while ((numero === null || isNaN(numero)) && !(numero <= num1 && numero >= num2));

    return numero;
}
function pedirNumeroRangoP(num1, num2) {
    let numero;

    numero = prompt("Introduce un número entre " + num1 + " y " + num2 + ":");

    // Convertimos a número y validamos
    numero = parseFloat(numero);

    // Verificamos si:
    // - No es un número válido (isNaN)
    if (isNaN(numero)) {

        numero = 30; // Forzamos a que siga en el bucle
    }
    return numero;
}
function pedirNumero(num) {
    let numero;
    let entrada;

    do {
        entrada = prompt("Introduce un número mayor a " + num + ":");

        // Si el usuario cancela o deja vacío, salimos retornando null
        if (entrada === null || entrada.trim() === "") {
            return null;
        }

        // Convertimos a número y validamos
        numero = parseFloat(entrada);

    } while (isNaN(numero) || numero <= num);

    return numero;
}