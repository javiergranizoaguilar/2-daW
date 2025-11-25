'use strict'
import { deleteFlags, createFlags, seleccionResult,flags,time } from "./Minas.js";
let contenedor = document.getElementById("tablero-visual");
function mostrarMatrix(matrixReal,matrixShow,isReal) {
    contenedor.innerHTML = "";
    // 2. Creamos una variable para guardar el HTML que vamos a generar
    let table = document.createElement("table");
    let matrix= isReal?[...matrixReal]:[...matrixShow]
    // 3. Recorremos las filas (<tr>)
    for (let x = 0; x < matrix.length; x++) {
        let tr = document.createElement("tr");

        // 4. Recorremos las columnas (<td>)
        for (let y = 0; y < matrix[x].length; y++) {
            let valor = matrix[x][y];

            let td = document.createElement("td");
            td.classList.add(`element${x}${y}`, "tile");
            td.onclick=()=>seleccionResult(x,y);
            td.oncontextmenu=(event)=>createFlags(event,x,y);
            td.ondblclick=()=>deleteFlags(x,y);
            td.textContent = valor;
            tr.appendChild(td);
        }
        table.appendChild(tr);
    }
    contenedor.appendChild(table);
    createP(!isReal?"Flags":"Tiempo",!isReal?flags:time);
}
function createP(text,valor){
    let p= document.createElement("p");
    p.textContent = text+valor;
    contenedor.appendChild(p);
}

export { mostrarMatrix };