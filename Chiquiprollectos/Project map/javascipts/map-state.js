/**
 * @file map-state.js
 * @description Gestión del estado de transformación (posición y escala) del mapa.
 */

import { mapLayer, MIN_SCALE } from './config.js';

// --- Variables de Estado del Mapa (Exportadas para ser manipuladas) ---
/** @type {number} Escala actual del mapa. */
export let scale = 1.0;
/** @type {number} Posición X actual del mapa. */
export let mapX = 0;
/** @type {number} Posición Y actual del mapa. */
export let mapY = 0;

/**
 * Actualiza la transformación CSS del 'map-layer' con los valores actuales de estado.
 * @function updateMapTransform
 */
export function updateMapTransform() {
    if (mapLayer) {
        mapLayer.style.transform = `translate(${mapX}px, ${mapY}px) scale(${scale})`;
    }
}

/**
 * Setter para actualizar las variables de estado de forma controlada.
 * @function setMapState
 * @param {number} newX Nueva posición X.
 * @param {number} newY Nueva posición Y.
 * @param {number} newScale Nueva escala.
 */
export function setMapState(newX, newY, newScale) {
    // Aplicamos límites de escala aquí
    scale = Math.max(MIN_SCALE, Math.min(3.0, newScale));
    mapX = newX;
    mapY = newY;
    updateMapTransform();
}

/**
 * Función que se puede usar para inicializar el mapa a una escala mínima.
 * @function initializeMap
 */
export function initializeMap() {
    // Inicializa el mapa a la escala mínima calculada.
    setMapState(mapX, mapY, MIN_SCALE);
    console.log(`✨ Mapa inicializado a escala: ${MIN_SCALE.toFixed(2)}`);
}