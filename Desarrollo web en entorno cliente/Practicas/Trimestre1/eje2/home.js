let lista=document.getElementById("lista");
 let num=document.getElementById("n");

for(let i=0;i<10;i++){
    let elemento=document.createElement("li");
    elemento.draggable=true;
    elemento.textContent="Elemento "+(i+1);
    elemento.id="elemento"+(i+1);
    lista.appendChild(elemento);
}
let textDragId="";

lista.addEventListener("dragstart",(e)=>{
    
    textDragId=e.target.id;
});
lista.addEventListener("dragover",(e)=>{
   e.preventDefault();
});
lista.addEventListener("drop",(e)=>{
    
    document.getElementById(e.target.id).insertAdjacentElement("beforebegin",document.getElementById(textDragId));
});
num.addEventListener("click",(e)=>{
 num.textContent= parseInt(num.textContent)+1;
});
