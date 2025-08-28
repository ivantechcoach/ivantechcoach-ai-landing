# Blog Modular "Ivan Tech Coach"

Este es un blog modular desarrollado en PHP y MySQL, diseñado para integrarse armoniosamente con la landing page principal de Ivan Tech Coach. Su objetivo es servir como un espacio de contenido dinámico (artículos, tutoriales, guías, historias) manteniendo una identidad visual coherente y ofreciendo una experiencia accesible para el público objetivo.

## Características Principales

*   **Frontend Público:**
    *   Listado de artículos dinámico desde la base de datos.
    *   Vista individual de artículos con URL amigables (slugs).
    *   Diseño responsivo y coherente con la marca Ivan Tech Coach.
    *   Manejo de imágenes destacadas y placeholders visuales.
*   **Panel de Administración (Backend):**
    *   Sistema de autenticación (login/logout).
    *   Dashboard de administración.
    *   Creación de nuevos artículos con validación de campos (título, slug, contenido, categoría, imagen).
    *   Gestión de artículos existentes (listado, edición y eliminación).
    *   Validación de formularios tanto en cliente (JavaScript) como en servidor (PHP).

## Estructura del Proyecto

```
.
├── index.php             # Home del blog: listado de artículos
├── article.php           # Vista individual de un artículo
├── partials/             # Componentes reutilizables (header, footer, sidebar)
├── assets/
│    ├── css/style.css    # Estilos generales del blog
│    ├── js/main.js       # Interactividad básica del blog
│    └── img/             # Imágenes del blog (subidas por el usuario)
├── config/
│    ├── db.php           # Configuración de conexión a MySQL (IGNORADO por Git)
│    └── db.sample.php    # Plantilla de configuración de DB para el repositorio
├── admin/                # Panel de administración
│    ├── login.php        # Acceso privado
│    ├── dashboard.php    # Panel de control
│    ├── new-article.php  # Crear artículo
│    ├── manage-articles.php # Gestionar artículos
│    ├── edit-article.php # Editar artículo
│    ├── auth.php         # Lógica de autenticación
│    ├── logout.php       # Cerrar sesión
│    ├── css/admin-style.css # Estilos del panel de administración
│    └── js/validation.js # Validación JS para admin
└── README.md             # Este archivo
```

## Requisitos

*   Servidor web (Apache, Nginx)
*   PHP 7.4+
*   MySQL 5.7+
*   Composer (opcional, para futuras dependencias)

## Configuración y Ejecución (Local - XAMPP)

1.  **Clonar el Repositorio:**
    ```bash
    git clone [URL_DEL_TU_REPOSITORIO_GITHUB] ivantechcoah-blog
    cd ivantechcoah-blog
    ```

2.  **Configurar la Base de Datos:**
    *   Crea una base de datos MySQL (ej. `ivantech_blog`) en tu phpMyAdmin.
    *   **Copia `config/db.sample.php` a `config/db.php`**.
    *   Edita `config/db.php` con tus credenciales de base de datos locales (ej. `DB_HOST: 'localhost'`, `DB_USER: 'root'`, `DB_PASS: ''`, `DB_NAME: 'ivantech_blog'`).
    *   Importa el esquema de la base de datos. Puedes usar el siguiente SQL para crear la tabla `articles`:
        ```sql
        CREATE TABLE `articles` (
          `id` INT(11) NOT NULL AUTO_INCREMENT,
          `title` VARCHAR(255) NOT NULL,
          `slug` VARCHAR(255) NOT NULL,
          `excerpt` TEXT,
          `content` LONGTEXT NOT NULL,
          `category` VARCHAR(100) NOT NULL,
          `image` VARCHAR(255) DEFAULT NULL COMMENT 'Ruta a la imagen destacada',
          `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
          PRIMARY KEY (`id`),
          UNIQUE KEY `slug_unique` (`slug`)
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
        ```
    *   (Opcional) Inserta un artículo de ejemplo:
        ```sql
        INSERT INTO `articles` (`title`, `slug`, `excerpt`, `content`, `category`, `image`) VALUES
        ('Guía Definitiva para Proteger tu WhatsApp', 'guia-definitiva-proteger-whatsapp', 'Aprende en 5 sencillos pasos cómo blindar tu cuenta de WhatsApp contra estafas y accesos no autorizados. Tu seguridad es lo primero.', '<p>El contenido completo de la guía sobre WhatsApp iría aquí, detallando cada paso con explicaciones claras y sencillas.</p><p><strong>Paso 1:</strong> Activar la verificación en dos pasos...</p>', 'Ciberseguridad práctica 🛡️', NULL);
        ```

3.  **Colocar el Proyecto:**
    *   Mueve la carpeta `ivantechcoah-blog` al directorio `htdocs` de tu instalación de XAMPP.

4.  **Acceder al Blog:**
    *   Abre tu navegador y visita `http://localhost/ivantechcoah-blog/`.
    *   Para el panel de administración, visita `http://localhost/ivantechcoah-blog/admin/login.php`.
    *   Credenciales de administración por defecto: `admin` / `password123`.

## Despliegue (Hosting en Línea)

1.  **Configurar Base de Datos en Hosting:**
    *   Crea una nueva base de datos y un usuario en el panel de control de tu hosting (ej. cPanel). Anota el host, nombre de DB, usuario y contraseña.
    *   Importa el archivo `.sql` de tu base de datos local a la base de datos recién creada en tu hosting.

2.  **Actualizar `config/db.php` para Producción:**
    *   **En tu máquina local**, edita `config/db.php` y reemplaza las credenciales locales con las de tu hosting.
    *   **Sube ÚNICAMENTE este archivo `config/db.php`** a tu servidor, sobrescribiendo el existente.

3.  **Subir Archivos:**
    *   Sube todos los archivos del proyecto (excepto `config/db.php` si ya lo subiste actualizado) a la ubicación deseada en tu hosting (ej. `public_html/blog/`).

## Contribución

Si deseas contribuir a este proyecto, por favor, sigue las mejores prácticas de Git (fork, branch, pull request).

---

**Ivan Tech Coach**
