// --- Constantes de la Cuadrícula ---
const rootStyles = getComputedStyle(document.documentElement);

// 1. Obtener el valor como una cadena de texto (incluye la unidad: "50px")
const gridSizeString = rootStyles.getPropertyValue('--grid-size'); 
const tokenTotalSizeString = rootStyles.getPropertyValue('--token-total'); 
// 2. Extraer el valor numérico (removiendo "px")
// Usamos parseFloat() para convertir la cadena en un número decimal
const GRID_SIZE =parseFloat(gridSizeString)??50;
const CENTER=isNaN(parseFloat(gridSizeString-tokenTotalSizeString))?2:parseFloat(gridSizeString-tokenTotalSizeString);
// const CENTER=2;
const mapContainer = document.getElementById('map-container');
const mapLayer = document.getElementById('map-layer');
const tokens = document.querySelectorAll('.token');

// --- Variables de Estado del Mapa ---
let scale = 1.0;
let mapX = 0;
let mapY = 0;
let isDraggingMap = false;
let lastMouseX, lastMouseY;

// --- Variables de Estado del Token ---
let selectedToken = null;
let isDraggingToken = false;
let tokenDragOffsetX = 0;
let tokenDragOffsetY = 0;

// --- Función de Ajuste a Cuadrícula (CORE) ---
function snapToGrid(value) {
    // Encuentra el múltiplo de GRID_SIZE más cercano
    return Math.round(value / GRID_SIZE) * GRID_SIZE;
}

// --- Funciones de Transformación (Actualiza el CSS) ---
function updateMapTransform() {
    mapLayer.style.transform = `translate(${mapX}px, ${mapY}px) scale(${scale})`;
}

// --- Lógica del Movimiento del Mapa (Panorámica) ---

mapContainer.addEventListener('mousedown', (e) => {
    // Detenemos el arrastre del mapa si el evento se origina en un token
    if (e.target.classList.contains('token')) {
        // Si el clic es en un token, el mapa no se arrastra
        return;
    }

    // Si el clic es en el mapa o el contenedor, iniciamos el arrastre del mapa
    isDraggingMap = true;
    mapContainer.style.cursor = 'grabbing';
    lastMouseX = e.clientX;
    lastMouseY = e.clientY;
});

document.addEventListener('mousemove', (e) => {
    if (isDraggingMap) {
        const deltaX = e.clientX - lastMouseX;
        const deltaY = e.clientY - lastMouseY;

        mapX += deltaX;
        mapY += deltaY;

        lastMouseX = e.clientX;
        lastMouseY = e.clientY;

        updateMapTransform();
    } else if (isDraggingToken && selectedToken) {
        // Cálculo de la nueva posición en el espacio del mapa, NO en la pantalla
        // Dividimos por la escala para obtener el movimiento real en el mapa
        const newLeftRaw = e.clientX - mapX - tokenDragOffsetX;
        const newTopRaw = e.clientY - mapY - tokenDragOffsetY;

        // Aplicamos la escala al movimiento del mouse
        selectedToken.style.left = `${newLeftRaw / scale}px`;
        selectedToken.style.top = `${newTopRaw / scale}px`;
    }
});

document.addEventListener('mouseup', () => {
    // Si estábamos arrastrando un token, aplicamos el snap
    if (isDraggingToken && selectedToken) {
        let currentLeft = parseFloat(selectedToken.style.left);
        let currentTop = parseFloat(selectedToken.style.top);

        // Aplicar la función de ajuste a la cuadrícula
        let newLeftSnapped = snapToGrid(currentLeft);
        let newTopSnapped = snapToGrid(currentTop);

        // Actualizar la posición final del token
        selectedToken.style.left = `${newLeftSnapped+CENTER}px`;
        selectedToken.style.top = `${newTopSnapped+CENTER}px`;
    }

    // Resetear estados
    isDraggingMap = false;
    isDraggingToken = false;
    selectedToken = null;
    mapContainer.style.cursor = 'grab';
});

// --- Lógica de Zoom (Rueda del Mouse) ---

mapContainer.addEventListener('wheel', (e) => {
    e.preventDefault();
    const zoomFactor = e.deltaY < 0 ? 1.1 : 1 / 1.1;
    const newScale = Math.max(0.5, Math.min(3.0, scale * zoomFactor));

    if (newScale !== scale) {
        const mouseX = e.clientX;
        const mouseY = e.clientY;

        const mapRelX = (mouseX - mapX) / scale;
        const mapRelY = (mouseY - mapY) / scale;

        scale = newScale;

        mapX = mouseX - mapRelX * scale;
        mapY = mouseY - mapRelY * scale;

        updateMapTransform();
    }
});

// --- Lógica del Movimiento de Fichas (Tokens) ---

tokens.forEach(token => {
    // Inicializar las posiciones, deben ser múltiplos de 50 para empezar
    let initialLeft = parseFloat(token.style.left);
    let initialTop = parseFloat(token.style.top);
    token.style.left = `${snapToGrid(initialLeft)}px`;
    token.style.top = `${snapToGrid(initialTop)}px`;

    token.addEventListener('mousedown', (e) => {
        e.stopPropagation(); // Evita que el clic arrastre el mapa
        isDraggingToken = true;
        selectedToken = token;
        // Calcular el offset del mouse dentro del token para evitar saltos
        // Se resta la posición del mapa (mapX, mapY) y se divide por la escala
        const tokenLeftAbs = parseFloat(token.style.left) * scale + mapX;
        const tokenTopAbs = parseFloat(token.style.top) * scale + mapY;

        tokenDragOffsetX = e.clientX - tokenLeftAbs;
        tokenDragOffsetY = e.clientY - tokenTopAbs;
    });
});

// Inicializar la transformación al cargar
updateMapTransform();