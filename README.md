# Proyecto zShop

zShop es un proyecto de tienda en línea dinámica desarrollado en PHP y MySQL, basado en una plantilla preexistente (http://www.zerotheme.com) que incluía el diseño HTML y CSS. El proyecto fue creado como parte de un trabajo académico, donde añado toda la funcionalidad backend, permitiendo la gestión de productos, categorías y contenidos a través de un panel administrativo. La plantilla original proporciona un diseño moderno y adaptable, mientras que el backend en PHP se encarga de la lógica de negocio y la interacción con la base de datos MySQL.

## Características

- **Frontend:** HTML, CSS (incluyendo `zerogrid` y `Font Awesome`), y `jQuery`.
- **Backend:** PHP.
- **Base de datos:** MySQL (archivo SQL incluido).
- **Funcionalidades principales:**
  - Gestión de productos y categorías.
  - Sistema de autenticación para el administrador.
  - Gestión de contenido dinámico (slides, productos, categorías).

## Estructura del Proyecto

- `zShop/` – Contiene los archivos principales del sistema.
  - `adm_*.php` – Páginas de administración para productos, categorías, y slides.
  - `alta_*.php` – Formularios para añadir nuevos productos y categorías.
  - `css/` – Archivos CSS personalizados para el estilo del sitio.
  - `images/` – Imágenes utilizadas en el sitio.
  - `js/` – Archivos JavaScript necesarios.
  - `owlcarousel/` – Librería de carrusel para mostrar productos destacados.
- `proyectoiaw.sql` – Archivo de la base de datos MySQL que debe ser importado para inicializar la estructura de datos.

## Instalación

1. Clona este repositorio:
   ```bash
   git clone https://github.com/miriamruiz2/zShop.git

2. Importa la base de datos `proyectoiaw.sql` en tu servidor MySQL.

3. Configura la conexión a la base de datos en el archivo `zShop/config.php`:
   ```php
   <?php
   $dsn = "mysql:dbname=nombre_base_datos;host=localhost";
   $usuario = "tu_usuario";
   $contrasena = "tu_contraseña";
   ?>
  - Asegúrate de reemplazar:
    - `nombre_base_datos` con el nombre de tu base de datos (por ejemplo, `proyectoiaw`).
    - `tu_usuario` con tu usuario de MySQL (por ejemplo, `root`).
    - `tu_contraseña` con la contraseña correspondiente (deja el campo vacío si no hay contraseña).

  4. Ejecuta el proyecto en un servidor local o en un entorno que soporte PHP y MySQL.

## Requisitos
- Servidor web con soporte PHP.
- Servidor MySQL.
