<?
/*	Modelo para Alojamientos */

class Bd_model extends CI_Model {

  function __construct() {
      // Constructoooooor
      parent::__construct();
      // Cargamos la base de datos
      $this -> load -> database();
    }

    function verDatosBd($idAlojamiento) {
      // Funcion que devuelve todos los datos de una bd de un alojamiento concreto
      // $idAlojamiento = id del alojamiento

      $sql = "SELECT * FROM bd WHERE idalojamiento='".$idAlojamiento."'";
      $resultado = $this -> db -> query($sql);
      return $resultado -> result();
    }

    function addBd($idAlojamiento, $usuario, $password, $basedatos, $host) {
      // Funcion que añade una base de datos a la base de datos de bases de datos... ¡base de datos!
      // $idAlojamiento = id del alojamiento al que se asocia
      // $usuario = nombre del shuario
      // $password = password (ya se pasa a sha1
      // $basedatos = nombre de la base de datos asignada
      // $host = el jost o la maquina que aloja la bd

      // A encriptar toca
      $password = sha1($password);

      $sql = "INSERT INTO bd (host, user, password, basededatos, idalojamiento) VALUES ('".$host."', '".$user."', '".$password."', '".$basededatos."', '".$idAlojamiento."')";
      $resultado = $this -> db -> query($sql);
      return true;
    }

    function changeCampoBd($idBd, $campo, $valor) {
      // Funcion que cambia un campo determinado en la bd
      // $idBd = id de la bd a tocar
      // $campo = campo a cambiar
      // $valor = nuevo valor

      // Si es el password hay que hacerle cositas
      if ($campo == "password") {
        $valor = sha1($valor);
      }

      $sql = "UPDATE bd SET '".$campo."'='".$valor."'";
      $resultado = $this -> db -> query($sql);
      return true;
    }

    function delBd($idBd) {
      // Funcion que borra una base de datos determinada
      // $idBd = id de la bd en la base de datos

      $sql = "DELETE FROM bd WHERE id='".$id."'";
      $resultado = $this -> db -> query($sql);
      // Aqui deberia ir el shell script que hace cochinadas
      return true;
    }

}
?>
