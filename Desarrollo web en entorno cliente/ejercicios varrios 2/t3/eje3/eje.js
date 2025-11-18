let button = document.getElementById("button");
let nav = document.getElementById("nav");


button.addEventListener('click', (e) => {
    nav.classList.toggle("deactive");
    e.stopPropagation();
});
document.addEventListener('click', (e) => {
    nav.classList = "deactive"
});
nav.addEventListener('click', (e) => {
    e.stopPropagation();
});