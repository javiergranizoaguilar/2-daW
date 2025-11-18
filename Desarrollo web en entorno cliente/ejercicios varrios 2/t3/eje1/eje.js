let x = 1;
let list = document.getElementById("list");
let button = document.getElementById("button");


button.addEventListener('click', ()=>{
    list.insertAdjacentHTML('afterbegin', `<li class="elemento${x} ">Elemento ${x}</li>`);
    x++;
});

list.addEventListener('click',(e)=>{
        e.target.classList.toggle("active");
});
list.addEventListener('dblclick',(e)=>{
        e.target.remove();
});