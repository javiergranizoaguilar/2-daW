let botonC = document.getElementById("botonC");
let botonV = document.getElementById("botonV");
let botonL = document.getElementById("botonL"); 
let lista = document.getElementById("lista");

botonC.addEventListener("click", () => {
    let clave = prompt("clave");
    let valor = prompt("valor");
    localStorage.setItem(clave, valor);
});
botonV.addEventListener("click",mostrar);
lista.addEventListener("dblclick", (e) => {
    let text = e.target.textContent
    let clave=text.slice(7,text.lastIndexOf("Valor")).trim();
    localStorage.removeItem(clave);
    mostrar();
});
botonL.addEventListener("click",()=>{
    localStorage.clear();
})
function mostrar() {
    lista.innerHTML = "";

    Object.keys(localStorage).forEach(clave => {
        let listaObjeto = document.createElement("li");
        listaObjeto.textContent = "Clave: " + clave + " Valor: " + localStorage.getItem(clave);
        lista.appendChild(listaObjeto);
    });
}