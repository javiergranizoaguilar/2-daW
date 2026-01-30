# Especificación Técnica: Plataforma VTT (Virtual Tabletop) & Marketplace

**Proyecto:** Trabajo de Fin de Grado (TFG) - Ingeniería Informática
**Versión del Documento:** 1.0.0
**Estado:** Definición de Arquitectura

---

## 1. Introducción

El presente documento establece las especificaciones técnicas para el desarrollo de una plataforma web integral orientada a la gestión y simulación de juegos de rol de mesa (RPG) en línea. El sistema, denominado **Djinni**, un Tablero Virtual (VTT - *Virtual Tabletop*) en tiempo real.

El propósito principal es centralizar el ecosistema de juego, permitiendo a los usuarios adquirir módulos de aventura y activos gráficos (mapas, tokens) y utilizarlos inmediatamente dentro de una interfaz de juego interactiva y sincronizada.

## 2. Objetivos del Proyecto

1.  **Sincronización en Tiempo Real:** Implementar una comunicación bidireccional de baja latencia para reflejar el movimiento de fichas y tiradas de dados instantáneamente entre todos los participantes.
2.  **Renderizado Gráfico Avanzado:** Desarrollar un motor gráfico web capaz de gestionar múltiples capas, iluminación dinámica (niebla de guerra) y manipulación de objetos mediante Canvas.
3.  **Persistencia Híbrida:** Diseñar un modelo de datos que combine la integridad referencial para transacciones comerciales con la flexibilidad de estructuras NoSQL (JSON) para el estado del tablero.

## 3. Arquitectura del Sistema

El sistema sigue un patrón de arquitectura **Headless** y orientada a servicios, desacoplando completamente la lógica de negocio de la interfaz de usuario.

### 3.1 Diagrama de Componentes

* **Cliente (Frontend):** Aplicación SPA (Single Page Application) que consume la API REST y se conecta al Hub de eventos.
* **Servidor (Backend API):** Expone endpoints REST para la gestión de usuarios, productos y persistencia de partidas.
* **Hub de Tiempo Real:** Servicio independiente encargado de distribuir las actualizaciones de estado a los clientes conectados.
* **Base de Datos:** Almacenamiento persistente de información relacional y semi-estructurada.

## 4. Stack Tecnológico

La selección de tecnologías responde a criterios de rendimiento, escalabilidad y modernidad en el desarrollo web.

| Capa | Tecnología Seleccionada | Justificación Técnica                                                                                                                                                                         |
| :--- | :--- |:----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------|
| **Frontend** | **React.js** | Librería líder para interfaces reactivas. Facilita la gestión del estado complejo de la UI del juego.                                                                                         |
| **Motor Gráfico** | **Konva.js** | Abstracción de alto rendimiento para **HTML5 Canvas**. Permite manejo de eventos en objetos gráficos, drag-and-drop y capas, esencial para un VTT.                                            |
| **Backend** | **Symfony 6/7 (PHP 8)** | Framework robusto que garantiza buenas prácticas (Inyección de Dependencias, SOLID). Uso de **API Platform** para agilizar el desarrollo REST.                                                |
| **Tiempo Real** | **Mercure Hub** | Protocolo basado en **Server-Sent Events (SSE)**. A diferencia de WebSockets tradicionales, es nativo en el ecosistema Symfony, gestiona la reconexión automática y es compatible con HTTP/2. |
| **Base de Datos** | **MySQL / MariaDB** | Excelente manejo de tipos de datos JSON nativos.                                                                                                                                              |
| **Infraestructura** | **Docker** | Contenerización de servicios (PHP, Nginx, Database, Mercure) para garantizar paridad entre desarrollo y producción.                                                                           |

## 5. Funcionalidades por Rol de Usuario

El sistema implementa un control de acceso basado en roles (RBAC) diferenciados:

### A. Jugador (Player)
* Acceso a salas mediante sistema de invitación/enlace.
* Interacción con el tablero: Movimiento de tokens propios, medición de distancias.
* Hoja de personaje digital con actualización en tiempo real.
* Chat de texto y log de tiradas de dados 3D.

### B. Director de Juego (Game Master - DM)
* **Gestión de Salas:** Creación, pausado y guardado de sesiones.
* **Editor de Mapas:** Carga de imágenes de fondo, definición de grid y barreras de visión.
* **Control Total:** Capacidad para mover cualquier ficha y gestionar la visibilidad de las capas.

### C. Administrador
* Gestión de usuarios y resolución de incidencias.

## 6. Modelo de Datos (Enfoque Híbrido)

Para optimizar el rendimiento, se utiliza una estrategia mixta de almacenamiento.

### 6.1 Modelo Relacional (SQL)
```mermaid
erDiagram
    %% RELACIONES DEL SISTEMA VTT / RPG
    USER ||--o{ GAME_SESSION : "juega/dirige"
    USER ||--o{ CHARACTER_SHEET : "crea/posee"
    GAME_SESSION ||--o{ SCENE : "tiene mapas"
    GAME_SESSION ||--o{ CHARACTER_SHEET : "contiene personajes"
    
    %% RELACIONES DE LA FICHA DE PERSONAJE
    CHARACTER_SHEET ||--o{ INVENTORY_ITEM : "tiene items"
    CHARACTER_SHEET ||--o{ ATTACK : "conoce ataques"
    CHARACTER_SHEET ||--o{ SPELL : "tiene hechizos"
    CHARACTER_SHEET ||--o{ PROFICIENCY : "tiene competencias"
    CHARACTER_SHEET ||--o{ ABILITY : "posee rasgos"

    %% RELACIÓN DE MONSTRUOS
    USER ||--o{ MONSTER : "crea monstruo homebrew"
    SCENE ||--o{ MONSTER : "aparece en la escena (Tokens)"

    %% ---------------- ENTIDADES DEL SISTEMA ----------------

    USER {
        int id PK
        string email
        string username
        string password_hash
        json roles
        string avatar_url
        datetime created_at
    }

    GAME_SESSION {
        int id PK
        int gm_id FK
        string title
        int user_id FK
        boolean is_active
        int current_scene_id FK
        datetime created_at
    }

    SCENE {
        int id PK
        int session_id FK
        string name
        int grid_width
        int grid_height
        blob background_blob
        json data_json
    }

    %% ---------------- ENTIDADES DE JUGADORES (PCs) ----------------

    CHARACTER_SHEET {
        int id PK
        int user_id FK
        int session_id FK
        string character_name
        string spellcasting_ability
        blob token_image_data
        blob portrait_image_data
        double caster_level
        json stats_json
        json bonuses_json
        
        %% Trasfondo y Personalidad
        text appearance
        text backstory
        text personality_traits
        text ideals "Ideales del personaje"
        text bonds "Vínculos del personaje"
        text flaws "Defectos del personaje"

        %% Estado y Recursos
        int exhaustion_level "Nivel de fatiga (ej: 0 a 6)"
        json currency_json "Array con monedas: [{name: 'Oro', count: 15}, ...]"
        json custom_counters_json "Contadores genéricos: [{name: 'Antorchas', current: 3, max: 5}]"
    }

    INVENTORY_ITEM {
        int id PK
        int character_id FK
        string name
        text description
        int quantity
        double weight
        boolean is_equipped
        json metadata
    }

    ATTACK {
        int id PK
        int character_id FK
        string name
        string damage_dice
        string damage_type
        string range
        boolean is_saving_throw
        text description
    }

    SPELL {
        int id PK
        int character_id FK
        string name
        int level
        string school
        text description
        boolean is_prepared
        boolean has_limited_uses
        int max_charges
        int current_charges
        enum recharge_type
        string casting_time
        string spell_range
        text components
        string duration
        text higher_level_description
    }

    PROFICIENCY {
        int id PK
        int character_id FK
        string name
        enum type "SKILL, TOOL, WEAPON"
        int value_modifier
    }

    ABILITY {
        int id PK
        int character_id FK
        string name
        text description
        string source_type
        boolean is_active
        boolean has_limited_uses
        int max_uses
        int current_uses
        enum recharge_type
    }

    %% ---------------- TABLA DE BESTIARIO (MONSTRUOS Y NPCs) ----------------

    MONSTER {
        int id PK
        int created_by_user_id FK "NULL si es del SRD oficial"
        
        %% IDENTIFICACIÓN Y FUENTE (NUEVO)
        string name "Ej: Aarakocra Aeromancer"
        string source_book "Ej: XMM"
        int page_number "Ej: 10"
        
        %% ESTADÍSTICAS BÁSICAS
        string size "Ej: M, L, G"
        string type "Ej: elemental, beast"
        string alignment "Ej: N, CE"
        int armor_class
        string ac_description "NULLABLE"
        int hit_points_average
        string hp_formula "Ej: 12d8 + 12"
        json speed "NUEVO: { walk: 20, fly: 50 }"
        
        %% ATRIBUTOS
        int str
        int dex
        int con
        int int_stat
        int wis
        int cha
        
        %% COMPETENCIAS Y PASIVAS (NUEVO)
        json saving_throws "Ej: { dex: 5, wis: 5 }"
        json skills "Ej: { arcana: 3, perception: 7 }"
        int passive_perception "Ej: 17"
        
        string challenge_rating "Ej: 4"
        text senses "Ej: Darkvision 60 ft."
        text languages "Ej: Aarakocra, Primordial"

        %% CAPACIDADES Y RASGOS (JSON)
        json traits "Habilidades pasivas (Undead Fortitude, etc.)"
        json spellcasting "Hechizos del monstruo"

        %% ECONOMÍA DE ACCIONES (JSON)
        json actions "Acciones normales (Multiataque, Slam)"
        json bonus_actions "Acciones Bonus"
        json reactions "Reacciones"
        
        %% ACCIONES LEGENDARIAS Y MÍTICAS
        int legendary_resistances_count "Ej: 3"
        int legendary_actions_count "Ej: 3"
        json legendary_actions "Lista de acciones legendarias"
        json mythic_actions "Acciones míticas"
        
        %% ENTORNO Y BOTÍN (NUEVO)
        json lair_actions "Acciones de Guarida"
        json regional_effects "Efectos Regionales"
        json environment "Ej: ['mountain', 'planar, air']"
        json treasure "Ej: ['implements', 'individual']"
        
        %% METADATOS Y ETIQUETAS DE FILTRADO (NUEVO)
        json tags "actionTags, damageTags, spellcastingTags..."
        json vtt_metadata "hasToken, hasFluff, otherSources..."
    }
```
![Diagrama de Arquitectura](app.png)

### 6.2 Modelo NoSQL / JSON (Estado del Juego)
Debido a la complejidad y variabilidad de un tablero de juego (cientos de coordenadas, estados de niebla, notas), el estado de la partida se almacena como un documento JSON dentro de la tabla `GameSession` o una tabla satélite `MapState`.

**Ejemplo de estructura JSON almacenada:**
```json
{
  "mapId": 105,
  "fogOfWar": "polygons_base64_string...",
  "tokens": [
    { "id": "t_1", "x": 400, "y": 350, "rotation": 90, "layer": "characters" },
    { "id": "t_2", "x": 120, "y": 200, "isHidden": true, "layer": "enemies" }
  ]
}
```
## 7. Flujo de Comunicación (Tiempo Real)

El ciclo de vida de una interacción en el tablero sigue el siguiente flujo secuencial:

1.  **Acción:** El Usuario A mueve una ficha en el Canvas (**Frontend**).
2.  **Petición:** React envía una petición `POST /api/game/move` a **Symfony** con las nuevas coordenadas.
3.  **Validación:** Symfony valida que el movimiento es legal (comprobación de colisiones y permisos de usuario).
4.  **Persistencia:** Symfony actualiza el estado `JSON` en la Base de Datos.
5.  **Publicación:** Symfony envía una notificación asíncrona al **Mercure Hub** (topic: `/game/{id}`).
6.  **Distribución:** Mercure envía el evento (Server-Sent Event) a todos los clientes suscritos (Usuario B, C, DM).
7.  **Reacción:** El cliente React de los otros usuarios recibe el evento y **Konva.js** anima la ficha a la nueva posición sin recargar la página.

## 8. Planificación del Desarrollo

**Fase 1: Configuración (Semanas 1-2):** Setup de Docker, Symfony y diseño de DB.

**Fase 2: Core VTT (Semanas 3-10):** Implementación de Konva.js, lógica de tablero y sincronización Mercure.

**Fase 5: Finalización:** Testing, corrección de bugs y documentación.

## 9. Implementaciones  a futuro

1. Creacion de un market place el cual permita cargar aventuras pre creadas