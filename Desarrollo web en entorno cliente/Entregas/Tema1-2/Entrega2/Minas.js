'use strict'
function BuscaMinas() {
    let size = pedirNumero(1, "Dame el tamaño de del tablero");
    let minesratio = pedirNumeroRango(0, 100);
    let matrix = TableroCreation(size, minesratio);
    let matrixShow = TableroCreation(size, 0);
    matrix = vacioslogic(matrix);
    console.table(matrix);
    console.table(matrixShow);
    play(matrix, matrixShow);
}
function play(matrix, matrixShow) {
    let verdad = true;
    do {
        if (seleccionResult(matrix, matrixShow) === null || ganar(matrix, matrixShow)) {
            verdad = false
        }
        pintar(matrixShow);
        console.table(matrixShow);
    } while (verdad);
    if (ganar(matrix, matrixShow)) {
        alert("Has ganado");
    } else {
        alert("Perdiste manco");
    }
}
function ganar(matrix, matrixShow) {
    let win = true
    for (let x = 0; x < matrix.length; x++) {
        for (let y = 0; y < matrix.length; y++) {
            if ((matrix[x][y] >= 0 && matrix[x][y] === matrixShow[x][y]) ||
                (matrix[x][y] === "." && matrix[x][y] === matrixShow[x][y]) ||
                matrix[x][y] === "*") {
            }
            else {
                win = false;
            }
        }
    }
    return win;
}
function seleccionResult(matrix, matrixShow) {
    let CoordX = pedirNumero(-1, "Dame la coordenad X");
    let CoordY = pedirNumero(-1, "Dame la coordenad Y");

    if (matrix[CoordX][CoordY] == "*") {
        return null;
    } else {
        return show(matrix, matrixShow, CoordX, CoordY);
    }
}
function show(matrix, matrixShow, rx, ry) {
    let aux = []
    switch (true) {
        case matrix[rx][ry] === ".":
            aux.push(desbloqueoblancos(matrix, matrixShow, rx, ry));
            break;
        case matrix[rx][ry] > 0:
            matrixShow[rx][ry] = matrix[rx][ry];
            aux.push(matrixShow)
            break;
    }
    return aux;
}
function vacioslogic(rejaI) {

    let aux1 = [];
    let aux2 = [];
    let x1 = 0;
    let x2 = 0;
    let y1 = 0;
    let y2 = 0;
    let minas = 0;
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

            minas = 0;
            for (x1; x1 <= x2; x1++) {
                for (let y1 = y - 1 < 0 ? 0 : y - 1; y1 <= y2; y1++) {

                    if (rejaI[x1][y1] != rejaI[x][y]) {
                        if (rejaI[x1][y1] === "*") {
                            minas++;
                        }
                    }
                }
            }
            switch (true) {
                case minas != 0:
                    aux2.push(minas);
                    break;
                case rejaI[x][y] === "*":
                    aux2.push("*");
                    break;
                case minas === 0:
                    aux2.push(".");
                    break;

            }
        }
        aux1.push(aux2);
    }
    return aux1;
}
function TableroCreation(size, ratio) {
    let matrix = [];
    let aux = []
    for (let x = 0; x < size; x++) {
        aux = [];
        for (let y = 0; y < size; y++) {
            if (ratio !== 0) {
                if (Math.floor(Math.random() * 100) <= ratio) {
                    aux.push("*");
                }
                else {
                    aux.push("X");
                }
            }
            else {
                aux.push("X");
            }
        }
        matrix.push(aux)
    }
    return matrix;
}
function pedirNumero(num, text) {
    let numero;
    let entrada;

    do {
        entrada = prompt(text);

        // Si el usuario cancela o deja vacío, salimos retornando null
        if (entrada === null || entrada.trim() === "") {
            prompt("Dame un numero mallor a 1");
        }

        // Convertimos a número y validamos
        numero = parseFloat(entrada);

    } while (isNaN(numero) || numero <= num);

    return numero;
}
function pedirNumeroRango(num1, num2) {
    let numero;
    do {
        numero = prompt("Introduce un número entre " + num1 + " y " + num2 + "para el ratio de minas:");

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
function desbloqueoblancos(rejaI, matrixShow, rx, ry) {
    let x1 = 0;
    let x2 = 0;
    let y1 = 0;
    let y2 = 0;
    let minas = 0;
    for (let x = 0; x < rejaI.length; x++) {
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
            for (x1; x1 <= x2; x1++) {
                for (let y1 = y - 1 < 0 ? 0 : y - 1; y1 <= y2; y1++) {

                    if ((x1 === rx && ((y1 - 1 === ry) || (y1 + 1 === ry)))
                        || (y1 === ry && ((x1 - 1 === rx) || (x1 + 1 === rx)))) {
                        if (rejaI[x1][y1] === "." && matrixShow[x1][y1] != ".") {
                            matrixShow[x1][y1] = rejaI[x1][y1];
                            desbloqueoblancos(rejaI, matrixShow, x1, y1);
                        }
                    }
                }
            }
        }
    }
}