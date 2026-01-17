# Especificación Técnica: Plataforma VTT (Virtual Tabletop) & Marketplace

**Proyecto:** Trabajo de Fin de Grado (TFG) - Ingeniería Informática
**Versión del Documento:** 1.0.0
**Estado:** Definición de Arquitectura

---

## 1. Introducción

El presente documento establece las especificaciones técnicas para el desarrollo de una plataforma web integral orientada a la gestión y simulación de juegos de rol de mesa (RPG) en línea. El sistema, denominado **[Nombre de tu Proyecto]**, combina un Tablero Virtual (VTT - *Virtual Tabletop*) en tiempo real con un Marketplace de contenidos digitales.

El propósito principal es centralizar el ecosistema de juego, permitiendo a los usuarios adquirir módulos de aventura y activos gráficos (mapas, tokens) y utilizarlos inmediatamente dentro de una interfaz de juego interactiva y sincronizada.

## 2. Objetivos del Proyecto

1.  **Sincronización en Tiempo Real:** Implementar una comunicación bidireccional de baja latencia para reflejar el movimiento de fichas y tiradas de dados instantáneamente entre todos los participantes.
2.  **Renderizado Gráfico Avanzado:** Desarrollar un motor gráfico web capaz de gestionar múltiples capas, iluminación dinámica (niebla de guerra) y manipulación de objetos mediante Canvas.
3.  **Persistencia Híbrida:** Diseñar un modelo de datos que combine la integridad referencial para transacciones comerciales con la flexibilidad de estructuras NoSQL (JSON) para el estado del tablero.
4.  **Ecosistema de Contenidos:** Facilitar la integración automática de productos comprados (aventuras pre-diseñadas) directamente en las sesiones de juego del usuario.

## 3. Arquitectura del Sistema

El sistema sigue un patrón de arquitectura **Headless** y orientada a servicios, desacoplando completamente la lógica de negocio de la interfaz de usuario.

### 3.1 Diagrama de Componentes

* **Cliente (Frontend):** Aplicación SPA (Single Page Application) que consume la API REST y se conecta al Hub de eventos.
* **Servidor (Backend API):** Expone endpoints REST para la gestión de usuarios, productos y persistencia de partidas.
* **Hub de Tiempo Real:** Servicio independiente encargado de distribuir las actualizaciones de estado a los clientes conectados.
* **Base de Datos:** Almacenamiento persistente de información relacional y semi-estructurada.

## 4. Stack Tecnológico

La selección de tecnologías responde a criterios de rendimiento, escalabilidad y modernidad en el desarrollo web.

| Capa | Tecnología Seleccionada | Justificación Técnica |
| :--- | :--- | :--- |
| **Frontend** | **React.js** | Librería líder para interfaces reactivas. Facilita la gestión del estado complejo de la UI del juego. |
| **Motor Gráfico** | **Konva.js** | Abstracción de alto rendimiento para **HTML5 Canvas**. Permite manejo de eventos en objetos gráficos, drag-and-drop y capas, esencial para un VTT. |
| **Backend** | **Symfony 6/7 (PHP 8)** | Framework robusto que garantiza buenas prácticas (Inyección de Dependencias, SOLID). Uso de **API Platform** para agilizar el desarrollo REST. |
| **Tiempo Real** | **Mercure Hub** | Protocolo basado en **Server-Sent Events (SSE)**. A diferencia de WebSockets tradicionales, es nativo en el ecosistema Symfony, gestiona la reconexión automática y es compatible con HTTP/2. |
| **Base de Datos** | **MySQL / MariaDB** | Soporte sólido para transacciones ACID (necesarias para el Marketplace) y excelente manejo de tipos de datos JSON nativos. |
| **Infraestructura** | **Docker** | Contenerización de servicios (PHP, Nginx, Database, Mercure) para garantizar paridad entre desarrollo y producción. |

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
* **Importación:** Carga automática de "Módulos Integrados" comprados en la tienda.

### C. Creador de Contenido (Seller)
* Subida de activos digitales (Packs de imágenes, Módulos de aventura).
* Gestión de precios y descripción de productos.
* Dashboard de ventas.

### D. Administrador
* Gestión de usuarios y resolución de incidencias.
* Moderación de contenidos en el Marketplace.

## 6. Modelo de Datos (Enfoque Híbrido)

Para optimizar el rendimiento, se utiliza una estrategia mixta de almacenamiento.

### 6.1 Modelo Relacional (SQL)
```mermaid
erDiagram
    %% =======================================================
    %% 1. MÓDULO DE USUARIOS Y SEGURIDAD
    %% =======================================================
    User {
        int id PK
        string email
        string password_hash
        string username
        json roles "['ROLE_USER', 'ROLE_DM']"
        string avatar_url
        datetime created_at
    }

    %% =======================================================
    %% 2. MÓDULO MARKETPLACE (TIENDA)
    %% =======================================================
    Product {
        int id PK
        int seller_id FK
        string title
        text description
        decimal price
        enum type "ASSET_PACK, MODULE"
        string file_url "Ruta al ZIP descargable"
        string thumbnail_url
        boolean is_published
        datetime created_at
    }

    Order {
        int id PK
        int user_id FK
        decimal total_amount
        string status "PENDING, PAID, REFUNDED"
        string payment_gateway_id
        datetime created_at
    }

    OrderItem {
        int id PK
        int order_id FK
        int product_id FK
        decimal price_at_moment "Precio congelado"
        int quantity
    }

    LibraryItem {
        int id PK
        int user_id FK
        int product_id FK
        datetime acquired_at
        boolean is_active
    }

    %% =======================================================
    %% 3. MÓDULO JUEGO (VIRTUAL TABLETOP)
    %% =======================================================
    GameSession {
        int id PK
        int gm_id FK "Director de Juego"
        string title
        string invite_code
        boolean is_active
        int current_scene_id FK
        datetime created_at
    }

    SessionParticipant {
        int id PK
        int user_id FK
        int session_id FK
        json permissions "{can_move_tokens: true}"
        string color_hex
        datetime joined_at
    }

    Scene {
        int id PK
        int session_id FK
        string name
        int grid_width
        int grid_height
        blob background_blob "Imagen Fondo (BLOB)"
        json data_json "ESTADO KONVA: Tokens, Muros, Niebla"
    }

    %% =======================================================
    %% 4. MÓDULO HOJA DE PERSONAJE (COMPLETO)
    %% =======================================================
    CharacterSheet {
        int id PK
        int user_id FK
        int session_id FK
        string character_name
        
        %% -- Característica de Lanzamiento --
        string spellcasting_ability "Ej: 'INT', 'WIS', 'CHA'"
        
        %% -- Imágenes Binarias --
        blob token_image_data "Imagen Ficha (BLOB)"
        blob portrait_image_data "Imagen Retrato (BLOB)"
        
        %% -- Estadísticas --
        double caster_level "Nivel de Mago (Double)"
        json stats_json "Fuerza, Des, Con, Int, Sab, Car"
        json bonuses_json "Buffs temporales, Raciales"
        
        %% -- Lore y Textos Largos --
        text appearance "Apariencia Física"
        text backstory "Historia y Trasfondo"
        text personality_traits "Rasgos, Ideales, Vínculos"
    }

    %% --- Tablas Satélite del Personaje ---

    InventoryItem {
        int id PK
        int character_id FK
        string name
        text description
        int quantity
        double weight
        boolean is_equipped
        json metadata "Ej: {magic_bonus: +1}"
    }

    Attack {
        int id PK
        int character_id FK
        string name
        string damage_dice "Ej: 2d6 + 4"
        string damage_type "Ej: Fuego, Cortante"
        string range "Ej: 5ft / 60ft"
        boolean is_saving_throw
    }

    Spell {
        int id PK
        int character_id FK
        string name
        int level
        string school
        text description
        boolean is_prepared
        
        %% -- Lógica de Usos Limitados --
        boolean has_limited_uses "True si no usa slots genéricos"
        int max_charges "Máximo de usos diarios"
        int current_charges "Usos restantes hoy"
        enum recharge_type "LONG_REST, SHORT_REST, DAWN"
    }

    Proficiency {
        int id PK
        int character_id FK
        string name "Ej: Sigilo, Espada Larga"
        enum type "SKILL, TOOL, LANGUAGE, WEAPON"
        int value_modifier "Ej: +2, +5"
    }

    %% =======================================================
    %% RELACIONES
    %% =======================================================
    
    %% Usuarios y Tienda
    User ||--o{ Product : "vende"
    User ||--o{ Order : "compra"
    User ||--o{ LibraryItem : "posee"
    User ||--o{ GameSession : "dirige (DM)"
    User ||--o{ SessionParticipant : "juega"
    User ||--o{ CharacterSheet : "crea/posee"

    %% Detalle Tienda
    Product ||--o{ OrderItem : "referenciado en"
    Product ||--o{ LibraryItem : "referenciado en"
    Order ||--o{ OrderItem : "contiene"

    %% Detalle VTT
    GameSession ||--o{ Scene : "tiene mapas"
    GameSession ||--o{ SessionParticipant : "tiene jugadores"
    GameSession ||--o{ CharacterSheet : "contiene personajes"

    %% Detalle Personaje (1 a Muchos)
    CharacterSheet ||--o{ InventoryItem : "tiene items"
    CharacterSheet ||--o{ Attack : "conoce ataques"
    CharacterSheet ||--o{ Spell : "tiene hechizos"
    CharacterSheet ||--o{ Proficiency : "tiene competencias"
```

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

**Fase 2: Core VTT (Semanas 3-7):** Implementación de Konva.js, lógica de tablero y sincronización Mercure.

**Fase 3: Marketplace (Semanas 8-10):** CRUD de productos, carrito y asociación de compras a usuarios.

**Fase 4: Integración (Semanas 11-12):** Conexión entre items comprados y su aparición en el VTT.

**Fase 5: Finalización:** Testing, corrección de bugs y documentación.