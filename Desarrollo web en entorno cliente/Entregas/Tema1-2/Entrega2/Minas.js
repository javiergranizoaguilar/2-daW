'use strict'

function buscaMinas() {
    let size = pedirNumeroEntero(1, "Dame el tamaño de del tablero", "Dame un numero mallor o igual a: ");
    let minesratio = pedirNumeroRango(0, 100);
    let matrix = tableroCreation(size, minesratio);
    let matrixShow = tableroCreation(size, 0);
    matrix = vaciosLogic(matrix);
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
                matrix[x][y] === "*") {} else {
                win = false;
            }
        }
    }
    return win;
}

function seleccionResult(matrix, matrixShow) {
    let coordX = pedirNumeroEntero(-1, "Dame la coordenad X", "Dame un numero mallor o igual a: ");
    let coordY = pedirNumeroEntero(-1, "Dame la coordenad Y", "Dame un numero mallor o igual a: ");

    if (matrix[CoordX][CoordY] == "*") {
        return null;
    } else {
        return show(matrix, matrixShow, coordX, coordY);
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

function vaciosLogic(rejaI) {
    let minas = 0;
    let aux1 = [];
    let aux2 = [];
    let x1 = 0;
    let x2 = 0;
    let y2 = 0;
    let aux;
    for (let x = 0; x < rejaI.length; x++) {
        aux2 = [];
        for (let y = 0; y < rejaI.length; y++) {
            aux = borderMargin(x, y, x1, x2, y2, rejaI)
            x1 = aux.newX1<0 ? 0:aux.newX1;
            x2 = aux.newX2<0 ? 0:aux.newX2;
            y2 = aux.newY2<0 ? 0:aux.newY2;
            print(x1);
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
            placingMines(minas, rejaI, aux2,x,y)
        }
        aux1.push(aux2);
    }
    return aux1;
}

function placingMines(mines, rejaI, aux2, x, y) {
    if (rejaI[x][y] === "*") {
        aux2.push("*")
    } else if (mines === 0) {
        aux2.push(".")
    } else {
        aux2.push(mines)
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
        numero = parseInt(entrada + num);

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

function borderMargin(x, y, x1, x2, y2, rejaI) {

    if (x - 1 < 0) {
        x1 = 0;
        x2 = x + 1;
    }
    if (x + 1 >= rejaI.length) {
        x1 = x - 1;
        x2 = rejaI.length - 1;
    }
    if (!(x + 1 >= rejaI.length && x - 1 < 0)) {
        x1 = x - 1;
        x2 = x + 1;
    }
    if (y - 1 < 0) {
        y2 = y + 1
    }
    if (y + 1 >= rejaI.length) {
        y2 = rejaI.length - 1;
    }
    if (!(y + 1 >= rejaI.length && y - 1 < 0)) {
        y2 = y + 1
    }
    return {
        newX1: x1,
        newX2: x2,
        newY2: y2
    }

}

function desbloqueoblancos(rejaI, matrixShow, rx, ry) {
    let x1 = 0;
    let x2 = 0;
    let y1 = 0;
    let y2 = 0;
    let aux;
    for (let x = 0; x < rejaI.length; x++) {
        for (let y = 0; y < rejaI.length; y++) {
            aux = borderMargin(x, y, x1, x2, y2, rejaI)
            x1 = aux.newX1;
            x2 = aux.newX2;
            y2 = aux.newY2;
            for (x1; x1 <= x2; x1++) {
                for (y1 = y - 1 < 0 ? 0 : y - 1; y1 <= y2; y1++) {

                    if ((x1 === rx && ((y1 - 1 === ry) || (y1 + 1 === ry))) ||
                        (y1 === ry && ((x1 - 1 === rx) || (x1 + 1 === rx)))) {
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