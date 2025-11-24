'use strict'
import { seleccionResult } from "./Minas.js";
function mostrarMatrix(matrix) {
    let contenedor = document.getElementById("tablero-visual");
    contenedor.innerHTML = "";
    // 2. Creamos una variable para guardar el HTML que vamos a generar
    let table = document.createElement("table");

    // 3. Recorremos las filas (<tr>)
    for (let x = 0; x < matrix.length; x++) {
        let tr = document.createElement("tr");

        // 4. Recorremos las columnas (<td>)
        for (let y = 0; y < matrix[x].length; y++) {
            let valor = matrix[x][y];

            let td = document.createElement("td");
            td.classList.add(`element${x}${y}`, "tile");
            td.onclick=()=>seleccionResult(x,y);
            td.textContent = valor;
            //td.addEventListener();
            tr.appendChild(td);
        }
        table.appendChild(tr);
    }
    contenedor.appendChild(table);
}

export { mostrarMatrix };