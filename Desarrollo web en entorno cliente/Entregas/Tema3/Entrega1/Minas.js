'use strict'
import { mostrarMatrix } from "./visual.js";

let matrix;
let matrixShow;
let gameEnded = false;
let mines = 0;
let flags = 0;
let startTime;
let finishTime;
let time;
document.getElementById("easy").onclick = () => buscaMinas(20);
document.getElementById("medium").onclick = () => buscaMinas(40);
document.getElementById("hard").onclick = () => buscaMinas(60);
function buscaMinas(minesratio) {
    gameEnded = false;
    mines = 0;
    flags = 0;
    startTime=getTime();
    let size = pedirNumeroEntero(1, "Dame el tamaño de del tablero", "Dame un numero mallor o igual a: ");
    matrix = tableroCreation(size, minesratio);
    matrixShow = tableroCreation(size, 0);
    mostrarMatrix(matrix, matrixShow, gameEnded);
    matrix = vaciosLogic(matrix);
    numberMines();
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
                win = false;
            }
        }
    }
    return win;
}

function seleccionResult(x, y) {
    if (matrixShow[x][y] != "f") {
        let coordX = x;
        let coordY = y;

        if (matrix[coordX][coordY] == "*") {
            alert("Perdiste");
            gameEnded = true;
            finishTime=getTime();
            timeBetwen(finishTime,startTime);
            mostrarMatrix(matrix, matrixShow, gameEnded);
        } else {
            show(matrix, matrixShow, coordX, coordY);
            if (ganar(matrix, matrixShow)) {
                alert("Ganaste");
                gameEnded = true;
                finishTime=getTime();
                timeBetwen(finishTime,startTime);
                mostrarMatrix(matrix, matrixShow, gameEnded);
            }
        }
    }
}

function show(matrix, matrixShow, rx, ry) {
    switch (true) {
        case matrix[rx][ry] === ".":
            desbloqueoBlancos(matrix, matrixShow, rx, ry);
            break;
        case matrix[rx][ry] > 0:
            matrixShow[rx][ry] = matrix[rx][ry];
            break;
    }
    mostrarMatrix(matrix, matrixShow, gameEnded)
}

function vaciosLogic(rejaI) {
    let minas = 0;
    let aux1 = [], aux2 = [];
    let xStart, xEnd, yStart, yEnd = 0;
    let aux;
    for (let x = 0; x < rejaI.length; x++) {
        aux2 = [];
        for (let y = 0; y < rejaI.length; y++) {
            aux = borderMarginWhite(x, y, rejaI)
            xStart = aux.newX1;
            xEnd = aux.newX2;
            yStart = aux.newY1;
            yEnd = aux.newY2;
            minas = 0;
            for (let xAux = xStart; xAux <= xEnd; xAux++) {
                for (let yAux = yStart; yAux <= yEnd; yAux++) {
                    if (rejaI[xAux][yAux] != rejaI[x][y]) {
                        if (rejaI[xAux][yAux] === "*") {
                            minas++;
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
function createFlags(e, x, y) {
    e.preventDefault();
    if (matrixShow[x][y] != "f" && flags <= mines) {
        matrixShow[x][y] = "f";
        flags++;
        mostrarMatrix(matrix, matrixShow, gameEnded);
        
    }
}
function deleteFlags(x, y) {
    if (matrixShow[x][y] == "f") {
        matrixShow[x][y] = "X";
        flags--;
    }
    mostrarMatrix(matrix, matrixShow, gameEnded);
}
function numberMines() {
    for (let x = 0; x < matrix.length; x++) {
        for (let y = 0; y < matrix.length; y++) {
            if (matrix[x][y] == "*") {
                mines++
            }
        }
    }
}
function getTime(){
    
    return Date.now();
}

function timeBetwen(tiempoFin, tiempoInicio) {
    const diferenciaMs = tiempoFin - tiempoInicio;
    const MS_EN_SEGUNDO = 1000;
    const MS_EN_MINUTO = MS_EN_SEGUNDO * 60;
    const MS_EN_HORA = MS_EN_MINUTO * 60;

    const horas = Math.floor(diferenciaMs / MS_EN_HORA);
    let residuoMs = diferenciaMs % MS_EN_HORA;

    const minutos = Math.floor(residuoMs / MS_EN_MINUTO);
    residuoMs %= MS_EN_MINUTO;

    const segundos = Math.floor(residuoMs / MS_EN_SEGUNDO);

    let resultado = [];
    
    if (horas > 0) {
        resultado.push(`${horas} hora${horas !== 1 ? 's' : ''}`);
    }
    if (minutos > 0) {
        resultado.push(`${minutos} minuto${minutos !== 1 ? 's' : ''}`);
    }
    if (segundos > 0 || (horas === 0 && minutos === 0)) {
        resultado.push(`${segundos} segundo${segundos !== 1 ? 's' : ''}`);
    }

    if (resultado.length === 0) {
         return "Menos de un segundo.";
    }
    time=resultado.join(', ');
}
export { seleccionResult, createFlags, deleteFlags, flags, time };