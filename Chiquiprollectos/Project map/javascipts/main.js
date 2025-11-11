/**
 * @file main.js
 * @description Punto de entrada principal: Inicializa todos los módulos y configura los event listeners globales.
 */

// Importar funciones de inicialización y manejo de eventos
import { mapContainer } from './config.js';
import { initializeMap, updateMapTransform, setMapState } from './map-state.js';
import { initializeTokenHandlers, handleTokenDragMove, handleTokenDrop } from './token-handler.js';
import { handleMapMouseDown, handleMapDragMove, handleMapMouseUp, handleZoom } from './map-handler.js';

/**
 * Inicializa toda la aplicación al cargar el DOM.
 * @function init
 */
function init() {
    console.log('✅ Sistema de mapa modular inicializado.');

    // 1. Inicializar el estado del mapa (escala inicial)
    initializeMap();

    // 2. Inicializar la posición y listeners de los tokens
    initializeTokenHandlers();

    // 3. Configurar Listeners Globales

    // --- Listeners de Panorámica y Zoom ---
    if (mapContainer) {
        // Escucha mousedown para iniciar el arrastre del mapa
        mapContainer.addEventListener('mousedown', handleMapMouseDown);
        // Escucha la rueda del mouse para el zoom
        mapContainer.addEventListener('wheel', handleZoom);
    }

    // --- Listeners Globales (para arrastrar en cualquier parte de la ventana) ---

    // Maneja el movimiento tanto del mapa como del token
    document.addEventListener('mousemove', (e) => {
        handleMapDragMove(e);
        handleTokenDragMove(e);
    });

    // Maneja la finalización de arrastre (mapa o token)
    document.addEventListener('mouseup', () => {
        handleMapMouseUp();
        handleTokenDrop();
    });
}

// Asegura que la inicialización ocurra solo después de que el DOM esté completamente cargado.
document.addEventListener('DOMContentLoaded', init);

// Llamar a init si el DOM ya está cargado (caso poco común, pero seguro)
if (document.readyState === 'complete') {
    init();
}