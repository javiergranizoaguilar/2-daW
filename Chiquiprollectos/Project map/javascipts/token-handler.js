/**
 * @file token-handler.js
 * @description Lógica de arrastre de tokens y ajuste a la cuadrícula.
 */

import { tokens, GRID_SIZE, CENTER } from './config.js';
import { mapX, mapY, scale } from './map-state.js'; // Importamos las variables de estado

// --- Variables de Estado del Token ---
let selectedToken = null;
export let isDraggingToken = false;
let tokenDragOffsetX = 0;
let tokenDragOffsetY = 0;

/**
 * Ajusta un valor a la celda de la cuadrícula más cercana.
 * @function snapToGrid
 * @param {number} value El valor de posición (left o top) en el espacio del mapa.
 * @returns {number} El valor ajustado al múltiplo de GRID_SIZE más cercano.
 */
function snapToGrid(value) {
    return Math.round(value / GRID_SIZE) * GRID_SIZE;
}

/**
 * Maneja el inicio del arrastre de un token.
 * @param {MouseEvent} e Evento del mouse.
 * @param {HTMLElement} token El elemento token que se está arrastrando.
 */
function handleTokenMousedown(e, token) {
    e.stopPropagation(); // Evita que el clic arrastre el mapa
    isDraggingToken = true;
    selectedToken = token;

    // Calcular la posición absoluta del token en la pantalla (ya escalada y desplazada)
    const tokenLeftRaw = parseFloat(token.style.left) || 0;
    const tokenTopRaw = parseFloat(token.style.top) || 0;

    const tokenLeftAbs = tokenLeftRaw * scale + mapX;
    const tokenTopAbs = tokenTopRaw * scale + mapY;

    // Calcular el offset del mouse dentro del token para evitar saltos
    tokenDragOffsetX = e.clientX - tokenLeftAbs;
    tokenDragOffsetY = e.clientY - tokenTopAbs;

    token.style.zIndex = 1000; // Eleva el token arrastrado
}

/**
 * Maneja la actualización de la posición del token durante el arrastre.
 * Esta función es llamada desde el 'mousemove' global.
 * @param {MouseEvent} e Evento del mouse.
 */
export function handleTokenDragMove(e) {
    if (isDraggingToken && selectedToken) {
        // Cálculo de la nueva posición en el espacio del mapa (relativo al `mapLayer`)
        // Se debe restar el desplazamiento del mapa (mapX, mapY) y dividir por la escala
        const newLeftRaw = e.clientX - mapX - tokenDragOffsetX;
        const newTopRaw = e.clientY - mapY - tokenDragOffsetY;

        // Establecer la posición **sin snap** para un arrastre fluido
        // Dividimos por la escala para obtener la posición real en el espacio del mapa
        selectedToken.style.left = `${newLeftRaw / scale}px`;
        selectedToken.style.top = `${newTopRaw / scale}px`;
    }
}

/**
 * Finaliza el arrastre y aplica el snap-to-grid.
 * Esta función es llamada desde el 'mouseup' global.
 */
export function handleTokenDrop() {
    if (isDraggingToken && selectedToken) {
        let currentLeft = parseFloat(selectedToken.style.left) || 0;
        let currentTop = parseFloat(selectedToken.style.top) || 0;

        // 1. Aplicar la función de ajuste a la cuadrícula
        let newLeftSnapped = snapToGrid(currentLeft);
        let newTopSnapped = snapToGrid(currentTop);

        // 2. Aplicar el ajuste de centrado (CENTER)
        selectedToken.style.left = `${newLeftSnapped + CENTER}px`;
        selectedToken.style.top = `${newTopSnapped + CENTER}px`;

        selectedToken.style.zIndex = ''; // Restaura el z-index
    }

    // Resetear estados
    isDraggingToken = false;
    selectedToken = null;
}

/**
 * Inicializa los listeners de mousedown para todos los tokens.
 * También asegura que las posiciones iniciales estén ajustadas a la cuadrícula.
 */
export function initializeTokenHandlers() {
    tokens.forEach(token => {
        // Asegurar que la posición inicial del token esté ajustada a la cuadrícula
        let initialLeft = parseFloat(token.style.left) || 0;
        let initialTop = parseFloat(token.style.top) || 0;
        token.style.left = `${snapToGrid(initialLeft) + CENTER}px`;
        token.style.top = `${snapToGrid(initialTop) + CENTER}px`;

        // Agregar el listener de inicio de arrastre
        token.addEventListener('mousedown', (e) => handleTokenMousedown(e, token));
    });
}