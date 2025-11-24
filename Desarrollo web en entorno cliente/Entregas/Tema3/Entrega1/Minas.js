'use strict'
import { mostrarMatrix } from "./visual.js";

let matrix;
let matrixShow;
document.getElementById("a").addEventListener('click', buscaMinas);
function buscaMinas() {
    let size = pedirNumeroEntero(1, "Dame el tamaño de del tablero", "Dame un numero mallor o igual a: ");
    let minesratio = pedirNumeroRango(0, 100);
    matrix = tableroCreation(size, minesratio);
    matrixShow = tableroCreation(size, 0);
    mostrarMatrix(matrixShow);
    matrix = vaciosLogic(matrix);
    console.table(matrix);
    console.table(matrixShow);

}

function ganar(matrix, matrixShow) {
    let win = true
    for (let x = 0; x < matrix.length; x++) {
        for (let y = 0; y < matrix.length; y++) {
            if (!((matrix[x][y] >= 0 && matrix[x][y] === matrixShow[x][y]) ||
                (matrix[x][y] === "." && matrix[x][y] === matrixShow[x][y]) ||
                (matrix[x][y] === "*")
            )) {
                console.log("a");
                win = false;
            }
        }
    }
    return win;
}

function seleccionResult(x, y) {
    let coordX = x;
    let coordY = y;

    if (matrix[coordX][coordY] == "*") {
        alert("Perdiste");
        mostrarMatrix(matrix);
    } else {
        show(matrix, matrixShow, coordX, coordY);
        if (ganar(matrix, matrixShow)) {
            alert("Ganaste");
            mostrarMatrix(matrix);
        }
    }
}

function show(matrix, matrixShow, rx, ry) {
    let aux = []
    switch (true) {
        case matrix[rx][ry] === ".":
            aux.push(desbloqueoBlancos(matrix, matrixShow, rx, ry));
            break;
        case matrix[rx][ry] > 0:
            matrixShow[rx][ry] = matrix[rx][ry];
            aux.push(matrixShow)
            break;
    }
    mostrarMatrix(matrixShow)
}

function vaciosLogic(rejaI) {
    let minas = 0;
    let aux1 = [];
    let aux2 = [];
    let x1 = 0;
    let x2 = 0;
    let y1 = 0;
    let y2 = 0;
    let aux;
    for (let x = 0; x < rejaI.length; x++) {
        aux2 = [];
        for (let y = 0; y < rejaI.length; y++) {
            aux = borderMarginWhite(x, y, rejaI)
            x1 = aux.newX1;
            x2 = aux.newX2;
            y1 = aux.newY1;
            y2 = aux.newY2;
            minas = 0;
            for (let x3 = x1; x3 <= x2; x3++) {
                for (let y3 = y1; y3 <= y2; y3++) {

                    if (rejaI[x3][y3] != rejaI[x][y]) {

                        if (rejaI[x3][y3] === "*") {

                            minas++;
                            console.log(rejaI[x3][y3]);
                        }
                    }
                }
            }
            placingMines(minas, rejaI, aux2, x, y);
        }
        aux1.push(aux2);
    }
    return aux1;
}

function placingMines(mines, rejaI, aux2, x, y) {
    if (rejaI[x][y] === "*") {
        aux2.push("*")
    } else {
        if (mines === 0) {
            aux2.push(".")
        } else {
            aux2.push(mines)
        }
    }
}

function tableroCreation(size, ratio) {
    let matrix = [];
    let aux = []
    for (let x = 0; x < size; x++) {
        aux = [];
        for (let y = 0; y < size; y++) {
            if (ratio !== 0 && Math.floor(Math.random() * 100) <= ratio) {
                aux.push("*");
            } else {
                aux.push("X");
            }
        }
        matrix.push(aux)
    }
    return matrix;
}

function pedirNumeroEntero(num, text, textError) {
    let numero;
    let entrada;

    do {
        entrada = prompt(text);

        // Si el usuario cancela o deja vacío, salimos retornando null
        if (entrada === null || entrada.trim() === "") {
            prompt(textError);
        }

        // Convertimos a número y validamos
        numero = parseInt(entrada);

    } while (isNaN(numero) || numero <= num);

    return numero;
}

function pedirNumeroRango(num1, num2) {
    let numero;
    do {
        numero = prompt("Introduce un número entre " + num1 + " y " + num2 + "para el ratio de minas:");

        // Convertimos a número y validamos
        numero = parseFloat(numero);

    } while ((numero === null || isNaN(numero)) && !(numero <= num1 && numero >= num2));

    return numero;
}

function borderMarginWhite(x, y, rejaI) {

    let x1 = x - 1;
    let x2 = x + 1;
    let y1 = y - 1;
    let y2 = y + 1;
    if (x - 1 < 0) {
        x1 = 0;
    }
    if (x + 1 >= rejaI.length) {
        x2 = rejaI.length - 1;
    }
    if (y - 1 < 0) {
        y1 = 0
    }
    if (y + 1 >= rejaI.length) {
        y2 = rejaI.length - 1;
    }
    return {
        newX1: x1,
        newX2: x2,
        newY1: y1,
        newY2: y2
    }

}

function desbloqueoBlancos(rejaI, matrixShow, rx, ry) {

    let aux;
    aux = borderMarginWhite(rx, ry, rejaI)
    let x1 = aux.newX1;
    let x2 = aux.newX2;
    let y1 = aux.newY1;
    let y2 = aux.newY2;
    for (let x = x1; x <= x2; x++) {
        for (let y = y1; y <= y2; y++) {
            if (
                (x === rx && ((y1 === y) || (y2 === y)))
                ||
                (y === ry && ((x1 === x) || (x2 === x)))
            ) {
                if (rejaI[x][y] === "." && matrixShow[x][y] != ".") {
                    matrixShow[x][y] = rejaI[x][y];
                    desbloqueoBlancos(rejaI, matrixShow, x, y);
                }
            }
        }
    }
}
export { seleccionResult };