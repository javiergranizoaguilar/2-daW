/**
 * @file map-handler.js
 * @description Lógica de Panorámica (Panning) y Zoom.
 */

import { mapContainer, MIN_SCALE } from './config.js';
import { mapX, mapY, scale, setMapState } from './map-state.js';
import { isDraggingToken } from './token-handler.js';

// --- Variables de Estado de Arrastre del Mapa ---
let isDraggingMap = false;
let lastMouseX, lastMouseY;

// --- Lógica de Panorámica (Panning) ---

/**
 * Inicia el arrastre del mapa si el evento no proviene de un token.
 * @param {MouseEvent} e Evento del mouse.
 */
export function handleMapMouseDown(e) {
    // Si el evento se origina en un token o estamos arrastrando un token, no arrastramos el mapa
    if (e.target.classList.contains('token') || isDraggingToken) {
        return;
    }

    isDraggingMap = true;
    if (mapContainer) {
        mapContainer.style.cursor = 'grabbing';
    }
    lastMouseX = e.clientX;
    lastMouseY = e.clientY;
}

/**
 * Continúa el arrastre del mapa y actualiza la posición.
 * Esta función es llamada desde el 'mousemove' global.
 * @param {MouseEvent} e Evento del mouse.
 */
export function handleMapDragMove(e) {
    if (isDraggingMap) {
        const deltaX = e.clientX - lastMouseX;
        const deltaY = e.clientY - lastMouseY;

        // Actualizar el estado del mapa
        const newMapX = mapX + deltaX;
        const newMapY = mapY + deltaY;

        setMapState(newMapX, newMapY, scale);

        lastMouseX = e.clientX;
        lastMouseY = e.clientY;
    }
}

/**
 * Finaliza el arrastre del mapa.
 */
export function handleMapMouseUp() {
    isDraggingMap = false;
    if (mapContainer) {
        mapContainer.style.cursor = 'grab';
    }
}

// --- Lógica de Zoom (Rueda del Mouse) ---

/**
 * Maneja el evento de rueda del mouse para realizar el zoom.
 * @param {WheelEvent} e Evento de la rueda del mouse.
 */
export function handleZoom(e) {
    e.preventDefault();

    // Determina el factor de zoom
    const zoomFactor = e.deltaY < 0 ? 1.1 : 1 / 1.1;

    // Calcular la nueva escala (limitada entre MIN_SCALE y 3.0)
    const newScale = Math.max(MIN_SCALE, Math.min(3.0, scale * zoomFactor));

    if (newScale !== scale) {
        const mouseX = e.clientX;
        const mouseY = e.clientY;

        // 1. Calcular el punto relativo (X, Y) del mapa bajo el mouse ANTES de la nueva escala
        const mapRelX = (mouseX - mapX) / scale;
        const mapRelY = (mouseY - mapY) / scale;

        // 2. Calcular la nueva posición para mantener el punto bajo el mouse
        const newMapX = mouseX - mapRelX * newScale;
        const newMapY = mouseY - mapRelY * newScale;

        // Actualizar el estado del mapa
        setMapState(newMapX, newMapY, newScale);
    }
}