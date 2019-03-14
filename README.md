# Peticion de Alojamiento Universidad de Valladolid

Aplicacion de uso interno para ayudar a la petición de alojamientos. Automatizar todo el proceso de creación (alojamiento, base de datos, cambio de contraseña y demás).

# Necesidades

PHP 5.3 aunque recomendado PHP 7, un MySQL como una casa y Babel para los componentes.

# En que esta montado

Se sigue el estandar del Area Web de la Universidad de Valladolid de aplicaciones donde el backend esta montado en PHP y CodeIgniter (por necesidades del equipo donde se aloja) y un front que, como aqui se puede hacer en lo que se quiera, se penso o en componentes web en javascript en vanilla o, como ha sucedido, en React.

No hay workflow de manejo y de hecho se va creando segun se esta montando gracias a que no hay una politica clara para este tipo de aplicaciones, ni de funcionamiento, ni de necesidad, ni de nada.

## Front End

HTML5, CSS3, Bootstrap, FontAwesome y Google Material Icons (porque son mas bonitos)... lo estandar para estas cosas. Javacript hecho en React, todo lo posible. Como esta en desarrollo no hay JS babelizados de producción aun.

Todos los controladores mandan y reciben JSON. Vamos es como se comunican con el backend.

Los componentes estan en desarrollo luego no estan ni babelizados ni nada.

### Componentes

Se pueden encontrar los siguientes componentes:

- alojamientosuserComponent.js > Lista los alojamientos de un usuario en concreto
- emailComponent.js > Para el envio de mensajes entre el usuario y la plataforma (y sus administradores)
- newComponent.js > Creacion de un alojamiento nuevo en cualquiera de las maquinas diferentes que hay en el Area Web
- verAlojamientoComponent.js > Muestra los datos del alojamiento y permite realizar las acciones con este

## Back End

Hecho en PHP con CodeIgniter y unos shell script por detras. Hay mucho "Web Service" creado para que el front de React se pueda comunicar con el back. Gracias a que no hay "nada" heredado, la comunicacion es por POST en JSON.

## Estado

Cosas que hay que ir haciendo:

- Aun en alpha sin terminar.
- Hay que montar un HTTPS o sino esto no se puede usar. Principalmente por seguridad.
- Esta metida la libreria para el SSH en PHP, pero los shell scripts estan sin poner.
- La parte de atras, donde los administradores van a hacer las cosas y revisar los alojamientos esta sin hacer. No esta elegido que, cual y donde va a ser el alcance y ese es el gran problema. Todo esto debido a las maquinas en si.
- Aun no estoy seguro de si SHA1 o MD5 los password y en si, para que guardarles. Al final quizas sea mejor generarlos *on the fly* y pasar de guardarlos por "mas seguridad". Total si alguien se le olvida, genera uno nuevo y pista, no tiene porque consultar el viejo, ¿verdad? ¿verdad? ¿verdad?... pero esto es politica y tampoco esta definida.
