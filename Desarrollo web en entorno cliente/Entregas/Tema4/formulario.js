let form = document.getElementById("formulario");
let numeroColumnas = document.getElementById("numeroColumnas");
let columnas = document.getElementById("columnas");
let inputs = document.getElementsByTagName("input");
let seccionFormulario = document.getElementById("secionFromulario");
let tablas = document.getElementById("tablas");
let numero=0;

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

    let columnNames = [];
    Array.from(inputs).forEach((e) => {
        if (e.type === "text") {
            columnNames.push(e.value);
        }
    });
    localStorage.setItem("nombres", JSON.stringify(columnNames));
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

        let div = document.createElement("div");

        div.appendChild(p);
        div.appendChild(input);

        columnas.appendChild(div);
    }
});
function crearTablas() {
    tablas.innerHTML = "";
    let nombresColumnas = JSON.parse(localStorage.getItem("nombres"));
    let primero = true;
    let n=0;
    nombresColumnas.forEach((e) => {

        let lista = document.createElement("div");
        let div = document.createElement("div");
        let p = document.createElement("p");
        p.textContent = e;
        div.appendChild(p);
        div.appendChild(lista);
        if (primero) {
            let boton = document.createElement("button");
            boton.textContent = "crear tarea";
            boton.id = "crear";
            div.appendChild(boton);
            primero = false

        }
        lista.id="tabla"+n;
        tablas.appendChild(div);
        n++;
    });
    creardragAndDrop();

}
function creardragAndDrop() {
    let crearboton = document.getElementById("crear");
    let tablaOriguinal = document.getElementById("tabla0");

    crearboton.addEventListener("click", () => {
        let tarea =prompt("Escrive la tarea");
        let div = document.createElement("div");
        let p = document.createElement("p");
        p.textContent = tarea;
        div.id=numero;
        numero++;
        div.appendChild(p);
        tablaOriguinal.appendChild(div);
        localStorage.setItem("numero",numero);
    })
}
