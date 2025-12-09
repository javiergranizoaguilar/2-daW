/*
let b1=document.getElementById("b1");
let b2=document.getElementById("b2");
let b3=document.getElementById("b3");

let d1=document.getElementById("d1");
let d2=document.getElementById("d2");
let d3=document.getElementById("d3");

b1.addEventListener("click",()=>{
    d1.classList.remove("inactivo");
    d2.classList.add("inactivo");
    d3.classList.add("inactivo");
    b1.classList.add("activoButton");
    b2.classList.remove("activoButton");
    b3.classList.remove("activoButton");
});
b2.addEventListener("click",()=>{
    d2.classList.remove("inactivo");
    d1.classList.add("inactivo");
    d3.classList.add("inactivo");
    b2.classList.add("activoButton");
    b1.classList.remove("activoButton");
    b3.classList.remove("activoButton");
});
b3.addEventListener("click",()=>{
    d3.classList.remove("inactivo");
    d2.classList.add("inactivo");
    d1.classList.add("inactivo");
    b3.classList.add("activoButton");
    b2.classList.remove("activoButton");
    b1.classList.remove("activoButton");
});
*/
let b1=document.getElementById("b1");
let b2=document.getElementById("b2");
let b3=document.getElementById("b3");

let d1=document.getElementById("d1");
let d2=document.getElementById("d2");
let d3=document.getElementById("d3");

let header=document.getElementById("header");
let main=document.getElementById("main");

header.addEventListener("click",(e)=>{
    Array.from(header.children).forEach(child => {
        child.classList.remove("activoButton");
    });
    e.target.classList.toggle("activoButton");
    Array.from(main.children).forEach(child => {
        child.classList.add("inactivo");
    });
   if(e.target.id==="b1"){
    d1.classList.remove("inactivo");
   }
   if(e.target.id==="b2"){
    d2.classList.remove("inactivo");
    }
    if(e.target.id==="b3"){
    d3.classList.remove("inactivo");
    }
});
