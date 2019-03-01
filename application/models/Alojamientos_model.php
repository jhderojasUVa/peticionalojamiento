<?
/*	Modelo para Alojamientos */

class Alojamientos_model extends CI_Model {

  function __construct() {
      // Constructoooooor
      parent::__construct();
      // Cargamos la base de datos
      $this -> load -> database();
    }

    function esElDuenyoAlojamiento($idAlojamiento, $idPersona) {
      // Nos dice si puede meter mano a un alojamiento, si es el responsable
      // $idAlojamiento = id del alojamiento
      // $idPersona = id de la persona a comprobar

      $sql = "SELECT id FROM alojamentos WHERE responsable='".$idPersona."' AND id='".$idAlojamiento."'";
      $resultado = $this -> bd -> query($sql);
      if ($resultado -> num_rows() > 0) {
        // Si, si puede
        return true;
      }
      // Al guano con el
      return false;
    }

    function devuelveTodosAlojamientosPersona($identificadorPersona) {
      // Funcion que devuelve todos los alojamientos de una persona determinada
      // $identificadorPersona = identificador usuario LDAP (e+DNI+letra)
      // Devuelve el resultado de la query

      $sql = "SELECT * FROM alojamientos WHERE responsable='".$identificadorPersona."' ORDER BY fechaPeticion DESC";
      $resultado = $this -> db -> query($sql);
      return $resultado -> result();
    }

    function devuelveDatosAlojamiento($idusuario) {
      // Funcion que devuelve el contenido (datos) de un alojamiento concreto
      // $idAlojamiento = identificador del alojamiento
      // Devuelve el resultado de la query

      $sql = "SELECT * FROM alojamientos WHERE responsable='".$idusuario."'";
      $resultado = $this -> db -> query($sql);
      return $resultado -> result();
    }

    function devuelveDatosAlojamientoyBD($idusuario) {
      // Devuelve todos los alojamientos del usuario y ademas mete true o false si tiene (el alojamiento) bd
      // $idusuario = id del shurario

      $sql = "SELECT alojamientos.id, alojamientos.host, alojamientos.user, alojamientos.host, emailContacto, ip, idestado, url, alias, fechaPeticion, fechaRealizacion, bd.basededatos FROM alojamientos LEFT JOIN bd ON alojamientos.id=bd.idalojamiento WHERE alojamientos.responsable='".$idusuario."'";
      $resultado = $this -> db -> query($sql);
      return $resultado -> result();
    }

    function devuelveEmailContacto($idAlojamiento) {
      // Devuelve el email del responsable
      // false si no

      $sql = "SELECT emailContacto FROM alojamientos WHERE id='".$idAlojamiento."'";
      $resultado = $this -> db -> query($sql);

      foreach($resultado -> result() as $row) {
        return $row -> emailContacto;
      }
      return false;
    }

    function devuelveAlojamientosNuevos() {
      // Funcion (sin nada) que devuelve solo los alojamientos nuevos
      // ¿por que has puesto "nuevo" en el estado, ¿verdad? ¿verdad? ¿verdad? ¿verdad? ¿verdad?
      // ¿verdad? ¿verdad? ¿verdad? ¿verdad? ¿verdad? ¿verdad? ¿verdad? ¿verdad?
      // ¿verdad? ¿verdad? ¿verdad? ¿verdad? ¿verdad? ¿verdad? ¿verdad? ¿verdad? ¿verdad? ¿verdad?

      $sql = "SELECT alojamientos.id, alojamientos.host, alojamientos.user, alojamientos.emailContacto, alojamientos.responsable, alojamientos.fechaPeticion, estado.estado FROM alojamientos INNER JOIN estado ON alojamientos.idestado=estado.id";
    }

    function verDatosAlojamiento($idAlojamiento) {
      // Funcion que devuelve los datos de un alojamiento concreto
      // $idAlojamiento = id del alojamiento

      $sql = "SELECT alojamientos.id, alojamientos.host, responsable, alojamientos.user, alojamientos.host, emailContacto, ip, idestado, url, alias, fechaPeticion, fechaRealizacion, bd.basededatos FROM alojamientos LEFT JOIN bd ON alojamientos.id=bd.idalojamiento WHERE alojamientos.id='".$idAlojamiento."'";
      $resultado = $this -> db -> query($sql);
      return $resultado -> result();
    }

    function changeDatosAlojamiento($idAlojamiento, $campo, $valor) {
      // Funcion que cambia un campo determinado de un alojamiento
      // $idAlojamiento = id del alojamiento
      // $campo = nombre del campo a cambiar
      // $valor = nuevo valor que le amos a meter

      if ($campo == "pass") {
        $valor = sha1($valor);
      }
      $sql = "UPDATE alojamientos SET ".$campo."='".$valor."' WHERE id='".$idAlojamiento."'";
      $resultado = $this -> db -> query($sql);
      return true;
    }

    function delAlojamiento($idAlojamiento) {
      // Funcion que se cepilla un alojamiento de la base de datos (y luego tendra que llamar al shell)
      // $idAlojamiento = identificador del alojamiento que vamos a mandar al guano

      // Primero la bd
      $sql = "DELETE FROM bd WHERE idalojamiento='".$idAlojamiento."'";
      $resultado = $this -> db -> query($sql);
      // Aqui iria el shell script que hace cochinadas

      // Luego el alojamiento en si
      $sql = "DELETE FROM alojamientos WHERE id='".$idAlojamiento."'";
      $resultado = $this -> db -> query($sql);
      // Aqui iria el shell script que hace cochinadas

      return true;
    }

    function addalojamiento($host, $user, $password, $responsable, $emailContacto, $ip, $url, $alias, $descripcion) {
      // Funcion que guarda en la bd los datos de un alojamiento nuevo
      // $host = maquina que alberga el alojamiento (alojamientos, albergue...)
      // $user = usuario del alojamiento
      // $password = el password para ese usuario
      // $responsable = identificador de la UVa de quien ha pedido el cacharro
      // $emailContacto = direccion de correo donde recivira el chorreo de mensajes
      // $ip = IPs permitidas (* para todas)
      // $url = host *.uva.es que quiere el usuario
      // $alias = alias que montaremos
      // $descripcion = la pelicula que nos cuenta
      // Devuelve true o false segun todo haya ido bien o no

      if (!$host || !$user || !$password || !$responsable || !$emailContacto || !$ip || !$url || !$alias || !$descripcion) {
        return false;
      }

      // Primero codificar el password
      $password = sha1($password);

      // Luego la fecha
      $fechaPeticion = date('Y-m-d');

      // Insertar
      $sql = "INSERT INTO alojamientos (host, user, pass, responsable, emailContacto, ip, url, alias, descripcion, fechaPeticion) VALUES ('".$host."', '".$user."', '".$password."', '".$responsable."', '".$emailContacto."', '".$ip."', '".$url."', '".$alias."', '".$descripcion."', '".$fechaPeticion."')";
      $this -> db -> query($sql);

      // Leer
      $sql = "SELECT id FROM alojamientos WHERE host='".$host."' AND user='".$user."' AND descripcion='".$descripcion."'";
      $resultado = $this -> db -> query($sql);
      if ($resultado -> num_rows() > 0) {
        return true;
      } else {
        return false;
      }
    }

}
?>
