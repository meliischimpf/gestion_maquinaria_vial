# Gestión de Maquinaria Vial

![Laravel Logo](![logo-laravel-1024](https://github.com/user-attachments/assets/82de67ac-e546-4b39-b25d-535477f7d922))
![Tailwind CSS Logo](![tailwind-css-4096](https://github.com/user-attachments/assets/3aa7d196-4c10-4ae1-8001-468c20bb5319))


Una aplicación web de gestión de recursos y operaciones para la construcción desarrollada con Laravel y Tailwind CSS.

---

## 📋 Contenido

- [Características Principales](#-características-principales)
- [Requisitos](#-requisitos)
- [Instalación](#-instalación)
- [Configuración del Entorno](#-configuración-del-entorno)
- [Base de Datos](#-base-de-datos)
- [Levantar el Servidor](#-levantar-el-servidor)
- [Credenciales de Acceso](#-credenciales-de-acceso)
- [Estructura del Proyecto](#-estructura-del-proyecto)
- [Contribución](#-contribución)
- [Licencia](#-licencia)

---

## ✨ Características Principales

* **Gestión de Máquinas:** Control y seguimiento de la maquinaria.
* **Gestión de Obras:** Administración de proyectos y ubicaciones.
* **Asignación de Recursos:** Vinculación de máquinas a obras con control de fechas.
* **Administración de Parámetros:** Configuración de valores clave del sistema.
* **Envío de Mails:** Notificaciones de mantenimiento y ventas en mail.
* **Generación de Reportes:** Reportes en formato .PDF según mes y año de la Asignación de la Máquina.
* **Interfaz Moderna:** Desarrollada con Tailwind CSS para una estética limpia y responsive, compatible con modo claro/oscuro.
* **Autenticación de Usuarios:** Basado en Laravel Breeze.
* **Validación de Datos:** Mediante Laravel Form Requests.

---

## 🛠️ Requisitos

Asegúrate de tener los siguientes programas instalados en tu sistema, estas versiones fueron las utilizadas:

* **PHP:** `v8.4` (Laravel 12)
* **Composer:** `v2.8.5` (https://getcomposer.org/download/)
* **Node.js:** `v22.13.1` (LTS recomendado)
* **NPM:** `v11.2.0` (viene con Node.js)
* **Base de Datos:** MySQL.
* **Servidor Web:** Apache (o el servidor de desarrollo integrado de PHP/Laravel).
* **Git:** Para clonar el repositorio.

---

## 🚀 Instalación

Sigue estos pasos para levantar el proyecto en tu máquina local:

1.  **Clonar el Repositorio:**
    ```bash
    git clone [https://github.com/](https://github.com/meliischimpf/gestion_maquinaria_vial)].git
    cd [tu_repositorio]
    ```

2.  **Instalar Dependencias de Composer (PHP):**
    ```bash
    composer install
    ```

3.  **Instalar Dependencias de NPM (Frontend):**
    ```bash
    npm install
    ```

---

## ⚙️ Configuración del Entorno

1.  **Copiar el Archivo de Configuración:**
    Crea tu archivo de entorno `.env` a partir del ejemplo:
    ```bash
    cp .env.example .env
    ```

2.  **Generar la Key de la Aplicación:**
    Esta key es crucial para la seguridad de tu aplicación:
    ```bash
    php artisan key:generate
    ```

3.  **Configurar Variables de Entorno en `.env`:**
    Abre el archivo `.env` y ajusta las siguientes variables:

    * **Configuración de la Base de Datos:**
        ```dotenv
        DB_CONNECTION=mysql
        DB_HOST=127.0.0.1
        DB_PORT=3306
        DB_DATABASE=[tu_nombre_de_base_de_datos]
        DB_USERNAME=[tu_usuario_de_db]
        DB_PASSWORD=[tu_password_de_db]
        ```
        *(Asegúrate de que la base de datos `[tu_nombre_de_base_de_datos]` ya exista en tu sistema de gestión de bases de datos, por ejemplo, MySQL Workbench o phpMyAdmin).*

    * **Configuración del Mailer:**
	```dotenv
	MAIL_MAILER=smtp
	MAIL_HOST=sandbox.smtp.mailtrap.io 
	MAIL_PORT=587        
	MAIL_USERNAME=[tu_contraseña_de_mailtrap]
	MAIL_PASSWORD=[tu_contraseña_de_mailtrap]
	MAIL_ENCRYPTION=tls        
	MAIL_FROM_ADDRESS="[tu_mail_a_mostrar]" 
	MAIL_FROM_NAME="${[TU_APP_NAME]}"
	```
 
    * **Nombre de la Aplicación (Opcional):**
        ```dotenv
        APP_NAME="[TU_APP_NAME]"
        ```

    * **URL de la Aplicación (Importante para URLs y Assets):**
        ```dotenv
        APP_URL=http://localhost:8000
		http://[TU_APP_NAME].test
	
        ```

---

## 🗄️ Base de Datos

1.  **Ejecutar Migraciones:**
    Esto creará las tablas necesarias en tu base de datos.
    ```bash
    php artisan migrate
    ```

2.  **Seeders (Datos de Prueba):**
    ```bash
    php artisan db:seed
    ```

Los datos de prueba están comentados en App/Database/Seeders/DatabaseSeeder. Los datos no comentados son *necesarios* para el correcto funcionamiento de la aplicación

---

## ⬆️ Levantar el Servidor

1.  **Compilar Assets de Frontend:**
    Esto procesará tus archivos CSS (Tailwind) y JavaScript.
    ```bash
    npm run dev  # Para desarrollo (con live reload)
    # o
    npm run build # Para producción (compila y minifica)
    ```
    *Si usas `npm run dev`, mantén esta terminal abierta ya que recompila automáticamente al detectar cambios.*

2.  **Iniciar el Servidor de Desarrollo de Laravel:**
    ```bash
    php artisan serve
    ```

3.  **Acceder a la Aplicación:**
    Abre tu navegador y visita: `http://localhost:8000` o `https://[TU_APP_NAME].test`

---

## 📁 Estructura del Proyecto

Una breve descripción de las carpetas y archivos clave de Laravel:

* `app/`: Contiene el código fuente de tu aplicación (Modelos, Controladores, Providers, etc.).
    * `Models/`: Modelos de Eloquent (ej. `User.php`, `Machine.php`, `Work.php`, `Assignment.php`, `Parameter.php`).
    * `Http/Controllers/`: Lógica principal de la aplicación.
    * `Http/Requests/`: Validaciones de formularios (ej. `UpdateParameterRequest.php`).
* `bootstrap/`: Archivo de arranque del framework.
* `config/`: Archivos de configuración de la aplicación.
* `database/`: Migraciones, seeders y factorías para la base de datos.
* `public/`: El "punto de entrada" de tu aplicación, contiene los assets compilados.
* `resources/`: Vistas Blade (`.blade.php`), assets sin compilar (JS, CSS/SCSS).
    * `css/`: Archivos CSS fuente (donde configuras Tailwind).
    * `js/`: Archivos JavaScript.
    * `views/`: Plantillas Blade (ej. `layouts/app.blade.php`, `parameters/index.blade.php`, `machines/show.blade.php`).
* `routes/`: Definiciones de rutas (web, api, console, channels).
* `storage/`: Archivos generados por el framework (caches, logs, subidas de archivos).
* `vendor/`: Dependencias de Composer.
* `node_modules/`: Dependencias de NPM.

---


**Hecho con ❤️ por Melina**
