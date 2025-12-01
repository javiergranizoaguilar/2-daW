'use strict'
import { deleteFlags, createFlags, seleccionResult,flags,mines,time } from "./Minas.js";
let contenedor = document.getElementById("tablero-visual");
function mostrarMatrix(matrixReal,matrixShow,isReal) {
    let flagsLeft=mines;
    flagsLeft=mines-flags
    contenedor.innerHTML = "";
   
    let table = document.createElement("table");
    let matrix= isReal?[...matrixReal]:[...matrixShow]
    
    for (let x = 0; x < matrix.length; x++) {
        let tr = document.createElement("tr");

        for (let y = 0; y < matrix[x].length; y++) {
            let valor = matrix[x][y];

            let td = document.createElement("td");
            td.classList.add(`element${x}${y}`, "tile");
            td.onclick=()=>seleccionResult(x,y);
            td.oncontextmenu=(event)=>createFlags(event,x,y);
            td.ondblclick=()=>deleteFlags(x,y);
            createinterior(td,valor);
            //td.textContent = valor;
            tr.appendChild(td);
        }
        table.appendChild(tr);
    }
    contenedor.appendChild(table);
    createP(!isReal?"Flags":"Tiempo",!isReal?flagsLeft:time);
}
function createP(text,valor){
    let p= document.createElement("p");
    p.textContent = text+valor;
    contenedor.appendChild(p);
}
function createinterior(td,valor){
    switch(valor){
        case ".":
            break;
        case "*":
            createimg(td,m);
            break;
        case "f":
            createimg(td,valor);
            break;
            case "X":
            createimg(td,valor);
            break;
        default:
            td.textContent=valor;
            break;
    }
}
function createimg(apeendTo,valor){
    let img=document.createElement("img");
    img.src=`./imgs/${valor}.png`;
    img.alt=valor;
    apeendTo.appendChild(img);
}
export { mostrarMatrix };
