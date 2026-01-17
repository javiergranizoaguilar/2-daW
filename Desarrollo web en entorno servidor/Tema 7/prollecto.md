# Documentación Técnica: Plataforma VTT (Virtual Tabletop) & Marketplace

**Tipo de Proyecto:** Trabajo de Fin de Grado (TFG)
**Versión:** 1.0.0
**Estado:** En desarrollo / Finalizado

---

## 1. Descripción del Proyecto
Esta plataforma es una aplicación web híbrida que combina funcionalidades de **Virtual Tabletop (VTT)** —permitiendo a los usuarios jugar partidas de rol (como D&D) en tiempo real con mapas interactivos— y un **E-commerce** integrado para la compraventa de recursos digitales (assets, manuales, skins de dados).

El objetivo principal es proporcionar un entorno unificado donde la gestión de la partida y la adquisición de mejoras para la misma ocurran sin salir del ecosistema.

---

## 2. Stack Tecnológico

El proyecto sigue una arquitectura desacoplada (Headless), separando la lógica de negocio y la interfaz de usuario.

### 2.1 Frontend (Cliente)
* **Lenguaje:** JavaScript (ES6+)
* **Framework:** React.js
* **Gestión de Estado:** Redux / Context API (para gestión de sesión y estado del tablero).
* **Librerías Gráficas:** HTML5 Canvas API / Konva.js (para el renderizado de mapas y tokens).
* **Comunicación:** Axios (HTTP) y Socket.io/Mercure (Tiempo real para tiradas de dados y movimiento).

### 2.2 Backend (Servidor)
* **Lenguaje:** PHP 8.x
* **Framework:** Symfony 6/7
* **API:** API Platform (REST)
* **ORM:** Doctrine (para abstracción de base de datos).

### 2.3 Persistencia y Servicios
* **Base de Datos:** MySQL / MariaDB.
* **Almacenamiento:** Sistema de archivos local / AWS S3 (para imágenes de mapas y productos).

---

## 3. Arquitectura del Sistema

El sistema utiliza una arquitectura **Cliente-Servidor** mediante API RESTful.

1.  **Módulo VTT (Juego):** Requiere comunicación bidireccional en tiempo real.
    * *Flujo:* Usuario mueve ficha -> Evento Socket -> Servidor valida -> Broadcast a otros jugadores -> React actualiza el Canvas.
2.  **Módulo E-commerce (Tienda):** Comunicación transaccional clásica.
    * *Flujo:* Usuario añade al carrito -> Petición POST a Symfony -> Doctrine actualiza DB -> Respuesta JSON.

---

## 4. Prerrequisitos de Instalación

Para desplegar el entorno de desarrollo local, el evaluador necesita:

* **Node.js** (v18 o superior) y NPM/Yarn.
* **PHP** (v8.1 o superior) con extensiones: `intl`, `pdo_mysql`, `zip`.
* **Composer** (Gestor de dependencias PHP).
* **Servidor de Base de Datos** (MySQL local o Docker).
* **Symfony CLI** (Opcional, pero recomendado).