const modal = document.getElementById("popup")
const openButton = document.getElementById('openButton');
const closeButton = document.getElementById('outButton');
const body = document.body;
// Función para abrir el modal
function openModal() {
    modal.style.display = 'flex';
    body.classList.add('no-scroll');
}

// Función para cerrar el modal
function closeModal() {
    modal.style.display = 'none';
    body.classList.remove('no-scroll');
}

// Cerrar el modal al hacer click en el botón 'X'
closeButton.addEventListener('click', closeModal);
openButton.addEventListener('click', openModal);

// Opcional: Cerrar el modal al hacer click fuera del contenido (en el overlay)
modal.addEventListener('click', (e) => {
    if (e.target === modal) {
        closeModal();
    }
});
