let x = 1;



let button = document.getElementById("button");
button.addEventListener('click', ()=>{
    let list = document.getElementById("list");
    // CORRECCIÓN: Usar insertAdjacentHTML
    list.insertAdjacentHTML('beforebegin', `<li class="elemento ${x} ">Elemento ${x}</li>`);
    x++;
});
