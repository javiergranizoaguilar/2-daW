let imgG = document.getElementById("imgG");
let cImg = document.getElementById("containerImg");


cImg.addEventListener('click', (e) => {
    for (child of cImg.children) {
        if (child.classList.contains("active")) child.classList.toggle("active");
    }
    e.target.classList.toggle("active");
    imgG.src = e.target.src

});