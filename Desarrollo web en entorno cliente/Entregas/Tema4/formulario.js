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
        
        // --- CLASES AÑADIDAS ---
        div.classList.add("kanban-column"); // Estilo de la columna gris
        p.classList.add("column-title");    // Estilo del título
        lista.classList.add("task-list");   // Zona donde caen las tareas
        // ------------------------

        p.textContent = nombresColumnas[x];
        div.appendChild(p);
        div.appendChild(lista);

        if (x == 0) {
            let boton = document.createElement("button");
            boton.textContent = "+ Añadir una tarjeta";
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
    arrastrado = evento.target;
    arrastrado.style.opacity = "0.5";
}

function permitirSoltar(evento) {
    evento.preventDefault();
}

function soltar(evento) {
    evento.preventDefault();
    arrastrado.style.opacity = "1";
    let listaTamanio = JSON.parse(localStorage.getItem(this.id.replace("tabla", "lista"))).length ?? 0
    let tamanioMaximo = JSON.parse(localStorage.getItem("capacidad"))[this.id.replace("tabla", "")];
    
    if (listaTamanio < tamanioMaximo) {
        this.appendChild(arrastrado);
        actualizarListas()
    }
}

function creardragAndDrop() {
    let crearboton = document.getElementById("crear");
    let tablaOriguinal = document.getElementById("tabla0");

    if(crearboton){
        crearboton.addEventListener("click", () => {
            let listaData = JSON.parse(localStorage.getItem("lista0"));
            let listaTamanio = (listaData == null || listaData == 0) ? 0 : listaData.length;
            
            let capacidades = JSON.parse(localStorage.getItem("capacidad"));
            let tamanioMaximo = capacidades ? capacidades[0] : 999; // Fallback

            if (listaTamanio < tamanioMaximo) {
                let tarea = prompt("Escribe la tarea");
                if(tarea) {
                    creaTarea(tarea, tablaOriguinal);
                    recivirDevolverLista(tarea);
                }
            } else {
                alert("Columna llena");
            }
        })
    }
}

function creaTarea(tarea, tabla) {
    let div = document.createElement("div");
    let p = document.createElement("p");
    p.textContent = tarea;
    
    // --- CLASES ---
    div.classList.add("drag"); // Tu clase original, ahora estilizada en CSS
    // --------------

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
    actualizarListas()
}

function actualizarListas(){
    let x=0;

    do{
        localStorage.removeItem("lista"+x);
        let elementoTabla = document.getElementById("tabla"+x);
        if(elementoTabla) {
            let lista = elementoTabla.children;
            let listaAux=[];
            Array.from(lista).forEach(e => {
                listaAux.push(e.firstChild.textContent)
            });
            localStorage.setItem("lista"+x, JSON.stringify(listaAux))
            x++;
        } else {
            break;
        }
    } while(document.getElementById("tabla"+x)!=null);
}

window.addEventListener("load", () => {
    tablas.classList.toggle("desaparece");
    if (!(null == localStorage.getItem("nombres"))) {
        seccionFormulario.innerHTML = "";
        crearTablas();
        seccionFormulario.classList.toggle("desaparece");
        tablas.classList.toggle("desaparece");
    }
});


form.addEventListener("submit", (e) => {
    e.preventDefault();

    localStorage.clear();
    localArrray(input, "text", "nombres");
    localArrray(input, "number", "capacidad");

    seccionFormulario.innerHTML = "";
    crearTablas();
    seccionFormulario.classList.toggle("desaparece");
        tablas.classList.toggle("desaparece");
});


numeroColumnas.addEventListener("input", () => {
    let columnas = document.getElementById("columnas"); // Faltaba definir esta variable en tu scope global o aquí
    columnas.innerHTML = "";
    
    // Limitar visualmente para que no explote el navegador si ponen 1000
    let val = numeroColumnas.value > 20 ? 20 : numeroColumnas.value; 

    for (let i = 0; i < val; i++) {

        let p = document.createElement("p");
        p.textContent = "Columna " + (i + 1);

        let inputTxt = document.createElement("input");
        inputTxt.type = "text";
        inputTxt.placeholder = "Nombre";
        inputTxt.required = true; // Mejora UX

        let inputNum = document.createElement("input");
        // OJO: En tu código original tenías un bug aquí: `input.type = "number"`.
        // Eso cambiaba el tipo del input anterior. He creado variable nueva `inputNum`.
        inputNum.type = "number"; 
        inputNum.placeholder = "Capacidad";
        inputNum.required = true;

        let div = document.createElement("div");
        
        // --- CLASES AÑADIDAS ---
        div.classList.add("setup-row");
        // -----------------------

        div.appendChild(p);
        div.appendChild(inputTxt);
        div.appendChild(inputNum);

        columnas.appendChild(div);
    }
});