let form = document.getElementById("formulario");
let numeroColumnas = document.getElementById("numeroColumnas");
let input = document.getElementsByTagName("input");
let seccionFormulario = document.getElementById("secionFromulario");
let tablas = document.getElementById("tablas");


let arrastrado = null;


function localArrray(array, type, clave) {
    let primero = true;
    let arrayAux = [];
    Array.from(array).forEach((e) => {
        if (e.type === type) {
            if (primero && type == "number") { primero = !primero }
            else {
                arrayAux.push(e.value);
            }
        }
    });
    localStorage.setItem(clave, JSON.stringify(arrayAux));
}
function crearTablas() {
    tablas.innerHTML = "";
    let nombresColumnas = JSON.parse(localStorage.getItem("nombres"));
    for (let x = 0; x < nombresColumnas.length; x++) {
        let lista = document.createElement("div");
        let div = document.createElement("div");
        let p = document.createElement("p");
        p.textContent = nombresColumnas[x];
        div.appendChild(p);
        div.appendChild(lista);

        if (x == 0) {
            let boton = document.createElement("button");
            boton.textContent = "crear tarea";
            boton.id = "crear";
            div.appendChild(boton);
        }
        lista.id = "tabla" + x;
        lista.addEventListener('dragover', permitirSoltar);
        lista.addEventListener('drop', soltar);
        tablas.appendChild(div);
        let listaAux = JSON.parse(localStorage.getItem("lista" + x)) ?? [];
        listaAux.forEach((e) => {
            let columnas = document.getElementById("tabla" + x);
            creaTarea(e, columnas);
        });
    }
    creardragAndDrop();

}
function empezarArrastre(evento) {
    arrastrado= evento.target;
    arrastrado.style.opacity = "0.5";
}

function permitirSoltar(evento) {
    evento.preventDefault();
}

function soltar(evento) {
    evento.preventDefault();
    arrastrado.style.opacity = "1";

    
    let listaTamanio = (JSON.parse(localStorage.getItem(this.id)) ?? 0) == 0 ? 0 : JSON.parse(localStorage.getItem("lista0")).length;
    let tamanioMaximo = JSON.parse(localStorage.getItem("capacidad"))[this.id.replace("tabla", "")];
    console.log(this.id,tamanioMaximo,listaTamanio)
    if(listaTamanio < tamanioMaximo){
        this.appendChild(arrastrado);
    }
}


function creardragAndDrop() {
    let crearboton = document.getElementById("crear");
    let tablaOriguinal = document.getElementById("tabla0");

    crearboton.addEventListener("click", () => {
        let listaTamanio = (JSON.parse(localStorage.getItem("lista0")) ?? 0) == 0 ? 0 : JSON.parse(localStorage.getItem("lista0")).length;
        let tamanioMaximo = JSON.parse(localStorage.getItem("capacidad"))[0];
        if (listaTamanio < tamanioMaximo) {

            let tarea = prompt("Escrive la tarea");
            creaTarea(tarea, tablaOriguinal);
            recivirDevolverLista(tarea);

        }
    })
}
function creaTarea(tarea, tabla) {
    let div = document.createElement("div");
    let p = document.createElement("p");
    p.textContent = tarea;
    div.classList.add("drag");
    div.setAttribute("draggable", "true");
    div.addEventListener('dragstart', empezarArrastre);
    div.appendChild(p);
    tabla.appendChild(div);
}

function recivirDevolverLista(tarea) {
    let nombeLista = "lista0";
    let listaAux = JSON.parse(localStorage.getItem(nombeLista)) ?? [];
    listaAux.push(tarea);
    localStorage.removeItem(nombeLista);
    localStorage.setItem(nombeLista, JSON.stringify(listaAux));
}

window.addEventListener("load", () => {

    if (!(null == localStorage.getItem("nombres"))) {
        seccionFormulario.innerHTML = "";
        crearTablas();
        localStorage.getItem("numero");
    }
});


form.addEventListener("submit", (e) => {
    e.preventDefault();

    localStorage.clear();
    localArrray(input, "text", "nombres");
    localArrray(input, "number", "capacidad");

    seccionFormulario.innerHTML = "";
    crearTablas();

});


numeroColumnas.addEventListener("input", () => {
    columnas.innerHTML = "";
    for (let i = 0; i < numeroColumnas.value; i++) {

        let p = document.createElement("p");
        p.textContent = "Columna nº: " + (i + 1);

        let input = document.createElement("input");
        input.type = "text"

        let inputNumber = document.createElement("input");
        input.type = "number"

        let div = document.createElement("div");

        div.appendChild(p);
        div.appendChild(input);
        div.appendChild(inputNumber);

        columnas.appendChild(div);
    }
});
