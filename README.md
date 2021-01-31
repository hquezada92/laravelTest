## Instalación y configuración

En primer lugar es necesario configurar el archivo .env en el que se parametrizan algunas variables de entorno necesarias para el funcionamiento del proyecto, para esto es necesario hacer una copia del archivo .env.examplo y renombrar la copia a .env y sera este archivo en el que se realizen todas las configuraciones.

En primer lugar es necesario configurar la conexión con la base de datos, se utiliza la base de datos MySql para este proyecto y por consiguiente es necesario configurar las siguientes variables de entorno
- DB_CONNECTION=mysql
- DB_HOST=HOSTMYSQL
- DB_PORT=PUERTOMYSQL
- DB_DATABASE=DATABASEPROYECTO
- DB_USERNAME=USUARIOBD
- DB_PASSWORD=PASSWORDUSUARIO

En segundo lugar las variables de entorno para las funcinalidades de envio de correo que utiliza MAILGUN como servicio API de correo electronico
- MAILGUN_DOMAIN
- MAILGUN_SECRET

Por ultimo en cuanto a variables de entorno es necesario crear la variable de entorno con el secret para la autenticación JWT. Esto se realiza con el siguiente comando:
> php artisan jwt:secret

Posteriormente podemos proceder a la ejecución de los migrations de BD para la creacion de la estructura de BD usada por la aplicación. Podemos opcionalmente ejecutar los seeders para popular la BD con registros de ejemplo.
Correr migrations
> php artisan migrate
Correr migrations con seeders
> php artisan migrate --seed

Ejecutados todos los pasos anteriores solo es necesario mediante linea de comandos en la carpeta del proyecto ejecutar el comando siguiente para que la aplicación entre en ejecución y pueda ser probada.
> php artisan serve

Algunos pasos adicionales para optimización del proyecto previo a despliegues en producción a continuacióm.

- Desactivar el modo debugger modificacion a false el valor de la variable de entorno
> APP_DEBUG = false

- Optimizacion del autoloader de composer con el siguiente comando
> composer install --optimize-autoloader --no-dev

- Optimización de configuration loading con el siguiente comando
> php artisan config:cache

- Optimizacion del Route Loading con el siguiente comando
> php artisan route:cache

La aplicacion ha sido desplegada en la siguiente url para pruebas:
> https://app-laraveltest.herokuapp.com/

El dump de la BD se puede descargar con el siguiente enlace
> https://drive.google.com/file/d/1s7Xl8xlK4B9QEqPMcD9sV0xvK3JSwU-f/view?usp=sharing

La colección de endpoints de insomnia se puede descargar con el siguiente enlace
> https://drive.google.com/file/d/1psVbZZasXLNlpoEjojDuxnxiqEiq8HmV/view?usp=sharing