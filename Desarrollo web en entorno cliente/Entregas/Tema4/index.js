let form= document.getElementById("formulario");
let numeroColumnas= document.getElementById("numeroColumnas");
let columnas= document.getElementById("columnas");


form.addEventListener("submit",()=>{

});

numeroColumnas.addEventListener("input",()=>{
    columnas.innerHTML="";
    for (let i = 0; i < numeroColumnas.textContent; i++) {
        
        let p= document.createElement("p");
        p.textContent="Columna nº: "+(i+1);

        let input= document.createElement("input");
        input.type="text"

        let div=document.createElement("div");

        div.appendChild(p);
        div.appendChild(div);

        columnas.appendChild(div);
    }
});