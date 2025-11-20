'use strict'
function mostrarMatrix(matrix){
    let contenedor = document.getElementById("tablero-visual");
    
    // 2. Creamos una variable para guardar el HTML que vamos a generar
    let html = "<table>"; 

    // 3. Recorremos las filas (<tr>)
    for (let x = 0; x < matrix.length; x++) {
        html += "<tr>";
        
        // 4. Recorremos las columnas (<td>)
        for (let y = 0; y < matrix[x].length; y++) {
            let valor = matrix[x][y];
            
            // (Opcional) Si es "X" lo dejamos vacío visualmente para que se vea limpio
            // Si prefieres ver la X, quita este if
            /* if (valor === "X") { 
                valor = ""; 
            } */

            html += `<td>${valor}</td>`;
        }
        html += "</tr>";
    }

    html += "</table>";

    // 5. Inyectamos el HTML generado dentro del div
    contenedor.innerHTML = html;
}
export {mostrarMatrix};