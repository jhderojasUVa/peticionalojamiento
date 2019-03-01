# Peticion de Alojamiento Universidad de Valladolid

Aplicacion de uso interno para ayudar a la petición de alojamientos. Automatizar todo el proceso de creación (alojamiento, base de datos, cambio de contraseña y demás).

# Necesidades

PHP 5.3 aunque recomendado PHP 7.

# En que esta montado

## Front End

HTML5, CSS3, Bootstrap, FontAwesome y Google Material Icons (porque son mas bonitos)... lo estandar para estas cosas. Javacript hecho en React, todo lo posible. Como esta en desarrollo no hay JS babelizados de producción aun.

Todos los controladores mandan y reciben JSON.

## Back End

Hecho en PHP con CodeIgniter y unos shell script por detras. Hay mucho "Web Service" creado para que el front de React se pueda comunicar con el back. Gracias a que no hay "nada" heredado, la comunicacion es por POST en JSON.

## Estado

Aun en alpha sin terminar.

Hay que montar un HTTPS o sino esto no se puede usar.
