/**
 * @file config.js
 * @description Define las constantes iniciales, referencias del DOM y cálculos de escala.
 */

// --- Referencias del DOM ---
export const mapContainer = document.getElementById('map-container');
export const mapLayer = document.getElementById('map-layer');
// Usamos querySelectorAll para obtener una lista de todos los tokens
export const tokens = document.querySelectorAll('.token');

// Asegúrate de que los elementos críticos existan
if (!mapContainer || !mapLayer) {
    console.error("🛑 Error: No se encontraron los elementos 'map-container' o 'map-layer'.");
}

// --- Constantes de la Cuadrícula ---
const rootStyles = getComputedStyle(document.documentElement);

/**
 * Obtiene el valor numérico de una variable CSS.
 * @param {string} varName El nombre de la variable CSS (ej: '--grid-size').
 * @param {number} defaultValue El valor a usar si la variable no se puede leer.
 * @returns {number} El valor numérico de la variable CSS.
 */
function getCssNumericValue(varName, defaultValue = 0) {
    const valueString = rootStyles.getPropertyValue(varName);
    const numericValue = parseFloat(valueString.trim());
    return isNaN(numericValue) ? defaultValue : numericValue;
}

// Extraer y exportar las constantes de tamaño de la cuadrícula
export const GRID_SIZE = getCssNumericValue('--grid-size', 50);
const tokenSize = getCssNumericValue('--token-size', 42);
const tokenBorderSize = getCssNumericValue('--token-border-size', 3);
const tokenTotalSize= tokenSize+(tokenBorderSize*2);

// Calcular el 'CENTER' (desplazamiento para centrar el token en la celda si el tamaño del token es diferente)
// En el código original, el cálculo es: parseFloat(gridSizeString - tokenTotalSizeString)
// Asumo que si gridSize=50 y tokenTotal=46, CENTER sería 4 (50-46) o 2 (si se divide / 2).
// Lo ajustamos a una lógica de desplazamiento más clara.
export const CENTER = GRID_SIZE - tokenTotalSize;

// --- Cálculo de la Escala Mínima (Fit Screen) ---
const CONTAINER_WIDTH = mapContainer ? mapContainer.clientWidth : 0;
const CONTAINER_HEIGHT = mapContainer ? mapContainer.clientHeight : 0;
const MAP_WIDTH = mapLayer ? mapLayer.clientWidth : 0;
const MAP_HEIGHT = mapLayer ? mapLayer.clientHeight : 0;

// Calcular la escala necesaria para que el mapa quepa con un pequeño margen (1.1)
const scaleToFitWidth = CONTAINER_WIDTH / (MAP_WIDTH * 1.1);
const scaleToFitHeight = CONTAINER_HEIGHT / (MAP_HEIGHT * 1.1);

/**
 * Escala mínima para asegurar que todo el mapa es visible inicialmente.
 * @type {number}
 */
export const MIN_SCALE = Math.min(scaleToFitWidth, scaleToFitHeight);