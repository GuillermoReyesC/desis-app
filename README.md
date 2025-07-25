# Proyecto de habilidades tecnicas en php
Este proyecto es una demostración de habilidades técnicas en PHP nativo, incluyendo el uso de funciones, manejo de errores y buenas prácticas de programación.

## Descripción
Esta aplicación permite gestionar productos, materiales y sucursales. Incluye funcionalidades para crear, listar productos y materiales de productos, así como la gestión de sucursales y bodegas. La aplicación está diseñada para ser fácil de usar y mantener, siguiendo principios de programación limpia y modular.
utilizando POO se intenta manter una estructura clara y organizada del código, siguiendo el principio de separación de responsabilidades.

## Requisitos/recursos
- PHP 8.3
- docker
- docker-compose  
- Javascript
- HTML & css
- mysql 8.0

Docker no es necesario para el desarrollo, pero se recomienda para facilitar la instalación y despliegue de la aplicación y servidor mysql.

Al levantar docker-compose se levanta un servidor mysql y la aplicación en un contenedor separado.


## Instalación
1. Clona el repositorio:
    ```git clone https://github.com/GuillermoReyesC/desis-app.git```
2. Navega al directorio del proyecto:
    ```cd desis-app```
3. Construye y levanta los contenedores de Docker:
    ```docker-compose up -d```
4. Accede a la aplicación en tu navegador: [http://localhost:8080](http://localhost:8080)
5- mysql:
    - usuario: root
    - contraseña: rootpassword

## Estructura del Proyecto

- `controllers/`: Controladores que manejan la lógica de negocio.
- `models/`: Modelos que interactúan con la base de datos.
- `api/`: Endpoints de la API para interactuar con la aplicación.
- `public/`: Archivos públicos como CSS, JavaScript
- `views/`: Vistas que renderizan la interfaz de usuario.(sin utilizar)
- `index.php`: Punto de entrada de la aplicación.
- `docker-compose.yml`: Configuración de Docker Compose para levantar la aplicación.
- `Dockerfile`: Configuración del contenedor de la aplicación.
- `README.md`: Documentación del proyecto.

## Funcionalidades
- **Gestión de Productos**: Crear, listar  productos y asociar materiales.
- **Gestión de Materiales**: Crear, materiales asociados a productos.
- **Gestión de bodegas**: Listar bodegas
- **Gestión de Sucursales**: Listar sucursales segun la bodega seleccionada.
- **Validaciones**: Validaciones de formularios para asegurar la integridad de los datos.


